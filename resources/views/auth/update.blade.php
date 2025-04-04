<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Update Form -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4" style="width: 350px;">
            <h4 class="text-center mb-3">Update User</h4>
            <form action="{{ route('user.postUpdateUser', ['id' => $user->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" required>
                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}" required>
                    @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="btn btn-dark w-100">Update</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-light">
        <p>&copy; 2025 - Nguyen Thanh Ngoc. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>