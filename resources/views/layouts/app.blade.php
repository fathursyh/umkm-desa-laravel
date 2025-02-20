<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'UMKM System')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Remix Icon -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            .navbar {
                background: linear-gradient(135deg, #0d6efd 0%, #0a4cd7 100%);
                padding: 1rem 0;
                box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            }

            .navbar-brand {
                font-weight: 600;
                font-size: 1.5rem;
                color: #fff !important;
            }

            .nav-link {
                color: rgba(255,255,255,0.9) !important;
                font-weight: 500;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }

            .nav-link:hover, .nav-link.active {
                background-color: rgba(255,255,255,0.1);
                color: #fff !important;
            }

            .card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
                transition: transform 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card-header {
                background: #fff;
                border-bottom: 1px solid rgba(0,0,0,0.05);
                padding: 1.25rem;
            }

            .btn {
                padding: 0.5rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, #0d6efd 0%, #0a4cd7 100%);
                border: none;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #0a4cd7 0%, #093db1 100%);
                transform: translateY(-2px);
            }

            .dropdown-menu {
                border: none;
                box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
                border-radius: 0.5rem;
            }

            .alert {
                border-radius: 0.5rem;
                border: none;
            }

            .badge {
                padding: 0.5em 1em;
                border-radius: 0.5rem;
                font-weight: 500;
            }

            .table {
                vertical-align: middle;
            }

            .progress {
                height: 1rem;
                border-radius: 0.5rem;
                background-color: #e9ecef;
            }

            .progress-bar {
                background: linear-gradient(135deg, #0d6efd 0%, #0a4cd7 100%);
            }
        </style>

        @stack('css')
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ route('account.dashboard') }}">Portal Sistem</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    @auth
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('account.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('account.dashboard') }}">Dashboard</a>
                            </li>
                            
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('admin.submissions.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.submissions.index') }}">Manage Submissions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('admin.umkm.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.umkm.index') }}">Manage UMKM</a>
                                </li>
                                {{-- news --}}
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('admin.news.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.news.index') }}">Manage News</a>
                                </li>
                                
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('submissions.index') ? 'active' : '' }}" 
                                       href="{{ route('submissions.index') }}">My Submissions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }}" 
                                       href="{{ route('products.index') }}">My Products</a>
                                </li>
                            @endif
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form action="{{ route('account.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            {{-- @if(session('success'))
                <div class="container">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="container">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif --}}

            @yield('content')
        </main>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>

</html>
