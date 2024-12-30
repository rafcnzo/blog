<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  </head>
  <body>
    <div class="d-flex">
      <!-- Sidebar -->
      <div class="sidebar">
        <h4 style="text-align: center;">Admin Portal Berita</h4>
        <!-- Dashboard -->
        <a class="active" href="{{ route('dashboard') }}">
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

        <h2 class="mb-4" style="font-weight: bold;">Dashboard</h2>
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <i class="fas fa-user-plus"></i>
              <h5>Total Member</h5>
              <p>50</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <i class="fas fa-newspaper"></i>
              <h5>Total Berita</h5>
              <p>50</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="card">
              <i class="fas fa-comments"></i>
              <h5>Total Komentar</h5>
              <p>20</p>
            </div>
          </div>
        </div>

        <!-- Chart -->
        <div class="chart">
          <h5>Statistik Komentar Per Bulan</h5>
          <canvas id="commentsChart"></canvas>
        </div>
      </div>
    </div>

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
      // Chart JS initialization
      const ctx = document.getElementById('commentsChart').getContext('2d');
      const commentsChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
          datasets: [{
            label: 'Komentar',
            data: [12, 19, 3, 5, 2, 3, 7],
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
  </body>
</html>
