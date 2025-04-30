<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Zeni</title>
    <link rel="icon" type="image/png" href="/assets/images/logo-zeni.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --color-dark-green: #1B4D3E;
            --color-green: #4B7355;
            --color-light-green: #6B8C6E;
            --color-white: #FFFFFF;
        }
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
            color: #fff;
            min-height: 100vh;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }
        .navbar-brand img {
            height: 40px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .card-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-shadow: none;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .btn-primary {
            background: var(--color-dark-green);
            border: none;
        }
        .btn-primary:hover {
            background: var(--color-green);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        a {
            color: #007bff;
        }
        a:hover {
            color: #0056b3;
        }
        .dashboard-card {
            transition: transform 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .welcome-text {
            font-size: 2rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }
        .user-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
            <img src="/assets/images/logo-zeni.png" alt="Logo Zeni" class="h-12 w-auto transform hover:scale-110 transition-transform duration-300">
            <span class="text-2xl font-bold text-white">PUSDIKZI</span>
            </a>
            @auth
                <div class="ms-auto">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 