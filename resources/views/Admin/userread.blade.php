<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard - Pengguna</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar">
        <h4>Admin Portal Berita</h4>
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <!-- Pengguna -->
        <a href="{{ route('user.index') }}">
          <i class="fas fa-users"></i> Pengguna
        </a>

        <!-- Berita -->
        <a href="{{ route('news.index') }}">
          <i class="fas fa-newspaper"></i> Berita
        </a>
      </div>

      <!-- Content -->
      <div class="content flex-grow-1">
        <!-- User Info and Logout Button -->
        <div class="user-info">
            <!-- User Greeting (Hi, [Username] or Guest) -->
            <span class="user-greeting" onclick="toggleDropdown()">Hi, {{ auth()->user()->name ?? 'Guest' }}</span>
        
            <!-- Dropdown Menu -->
            <div id="dropdown-menu" class="dropdown-menu">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn fas fa-sign-out-alt">Logout</button>
                </form>
            </div>
        </div>

        <h2 class="mb-4" style="font-weight: bold;">Pengguna</h2>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-add-new">
              <i class="fas fa-user-plus"></i> Add New
            </a>
        </div>          

        <!-- Table Users -->
        <div class="card">
          <h5>List Pengguna</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID User</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                  <a href="{{ route('user.edit', $user->email) }}" class="text-primary">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('user.delete', $user->email) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin hapus user ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">
                        <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Pagination -->
          <nav>
            <ul class="pagination">
              {{ $users->links() }}
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggle the visibility of the dropdown menu
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
        }

        // Close the dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.user-greeting') && !event.target.matches('.logout-btn')) {
                var dropdown = document.getElementById('dropdown-menu');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }
    </script>
  </body>
</html>
