<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>Register</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <!-------------      image     ------------->
                <img src="images/white.png" alt="">
                <div class="text">
                    <p>Join the community of developers <i>- ludiflex</i></p>
                </div>
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                    <header>Create account</header>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-field">
                            <input type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="off">
                            <label for="name">Name</label>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="off">
                            <label for="email">Email</label>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="password" class="input" name="password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input type="password" class="input" name="password_confirmation" required>
                            <label for="password_confirmation">Confirm Password</label>
                        </div>

                        <div class="input-field">
                            <input type="submit" class="submit" value="Sign Up">
                        </div>

                        <div class="signin">
                            <span>Already have an account? <a href="{{ route('login') }}">Log in here</a></span>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>
