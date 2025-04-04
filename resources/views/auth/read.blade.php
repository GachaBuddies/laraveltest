<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.createUser') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- User Detail Box -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4" style="width: 400px;">
            <h4 class="text-center mb-3">User Details</h4>
            <div class="mb-3">
                <strong>ID:</strong> {{ $user->id }}
            </div>
            <div class="mb-3">
                <strong>Username:</strong> {{ $user->name }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div class="mb-3">
                <strong>Phone:</strong> {{ $user->phone }}
            </div>
            <div class="mb-3">
                <strong>Address:</strong> {{ $user->address }}
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn btn-danger btn-sm">Delete</a>
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