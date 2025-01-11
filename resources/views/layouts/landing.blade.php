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
            .news-card {
                background: white;
                border-radius: 10px;
                overflow: hidden;
                transition: transform 0.3s ease;
                height: 100%;
            }

            .news-card:hover {
                transform: translateY(-5px);
            }

            .news-card .card-img-top {
                height: 200px;
                object-fit: cover;
            }

            .news-card .card-body {
                padding: 1.25rem;
            }

            .news-card .card-date {
                color: #6c757d;
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
            }

            .news-card .card-title {
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 0.75rem;
            }

            .news-card .card-text {
                color: #6c757d;
                margin-bottom: 1rem;
            }

            .btn-read-more {
                color: #0d6efd;
                text-decoration: none;
                font-weight: 500;
            }

            .btn-read-more:hover {
                text-decoration: underline;
            }

            .more-news {
                background: rgba(255, 255, 255, 0.1);
                border: 2px dashed rgba(255, 255, 255, 0.2);
            }

            .more-news h4 {
                color: white;
            }

            .btn-more-news {
                background: #0d6efd;
                color: white;
                padding: 0.5rem 1.5rem;
                border-radius: 5px;
                text-decoration: none;
                transition: background 0.3s ease;
            }

            .btn-more-news:hover {
                background: #0b5ed7;
                color: white;
            }
        </style>

        @stack('css')
    </head>

    <body>
        @include('layouts.navbar-news')

        <!-- Main Content -->
        <main class="py-4" style="margin-top: 60px">

            @yield('content')
        </main>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>

</html>
