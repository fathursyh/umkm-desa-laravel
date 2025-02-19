<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/78160018aa.js" crossorigin="anonymous"></script>
    <title>@yield('title', 'Halaman Utama')</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid me-2"
                        style="max-width: 40px;">
                    <a class="navbar-brand mb-0" href="#">
                        <strong>KECAMATAN KEMANG</strong><br>KECAMATAN BOGOR
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profil Kelurahan
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('tentang') }}">Tentang</a></li>
                                <li><a class="dropdown-item" href="{{ route('staff') }}">Staff</a></li>
                                <li><a class="dropdown-item" href="{{ route('umkm') }}">UMKM</a></li>
                                <li><a class="dropdown-item" href="{{ route('kontak') }}">Kontak</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#kegiatan">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#layanan">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#berita">Berita</a>
                        </li>
                    </ul>
                    <a href="{{ route('account.login') }}">
                        <button class="btn btn-outline-custom" type="submit">Portal</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
