<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/regist.css') }}">
    <title>Halaman Register</title>
</head>
<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <div class="text">
                        <p>Daftar di<br><i>PORTAL BERITA SA 02</i></p>
                    </div>
                </div>

                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Create Account</header>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-field">
                                <input type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="off">
                                <label>Name</label>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-field">
                                <input type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="off">
                                <label>Email</label>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="role-field">
                                <label for="role">Select Role</label>
                                <select class="form-select" name="role" id="role" required>
                                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                                    <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-field">
                                <input type="password" class="input" name="password" required>
                                <label>Password</label>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-field">
                                <input type="password" class="input" name="password_confirmation" required>
                                <label>Confirm Password</label>
                            </div>

                            <div class="input-field">
                                <input type="submit" class="submit" value="Create Account">
                            </div>

                            <div class="signin">
                                <span>Already have an account? <a href="{{ route('login') }}">Sign in here</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>