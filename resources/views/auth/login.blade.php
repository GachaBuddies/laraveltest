<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.list') }}">EXE1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.list') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.createUser') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Box -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4" style="width: 350px;">
            <h4 class="text-center mb-3">Login</h4>
            <form method="POST" action="{{ route('user.authUser') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('user.createUser') }}">Register</a></p>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="{{ url('auth/google') }}" class="btn btn-danger">Login with Google</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-light">
        <p>&copy; 2025 - Nguyen Thanh Ngoc. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
