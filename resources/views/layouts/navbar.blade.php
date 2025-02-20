<div class="floating-socials">
    <a href="https://www.facebook.com/profile.php?id=100068911694483" target="_blank" class="social-icon facebook">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.instagram.com/kel_atangsenjaya/" target="_blank" class="social-icon instagram">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://twitter.com/" target="_blank" class="social-icon twitter">
        <i class="fab fa-twitter"></i>
    </a>
    <a href="https://tiktok.com/" target="_blank" class="social-icon tiktok">
        <i class="fab fa-tiktok"></i>
    </a>
</div>
{{-- Header Section --}}
<section id="header">
    <header>
        <nav id="navbarawal" class="navbar navbar-expand-lg navbar-dark shadow-lg fixed-top">
            <div class="container">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid me-2"
                        style="max-width: 40px;">
                    <a class="navbar-brand mb-0" href="/">
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
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link active" aria-current="page" href="#beranda">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kegiatan">Kegiatan</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#layanan">Layanan</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#berita">Berita</a>
                        </li>
                    </ul>
                    <a href="{{ route('account.login') }}">
                        <button class="btn btn-outline-custom" type="submit">Portal</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
</section>
