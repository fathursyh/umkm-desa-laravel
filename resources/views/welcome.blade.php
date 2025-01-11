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
        <title>Sistem Informasi Kelurahan Atangsan Jaya</title>
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
    </head>

    <body>
        @include('layouts.navbar')
        {{-- Beranda --}}
        <div class="container-fluid banner" id="beranda">
            <div class="container text-center">
                <h4 class="display-6">Selamat Datang di Website Kami</h4>
                <h3 class="display-1 fw-semibold">Kelurahan Atang Senjaya</h3>
            </div>
        </div>
        {{-- Kegiatan --}}
        <section id="kegiatan">
            <div class="container-fluid kegiatan pt-5 pb-5">
                <div class="container text-center">
                    <h2 class="text-uppercase mb-3">Kegiatan Masyarakat</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, tempora.</p>
                    <div class="row pt-4">
                        <div class="col-md-4">
                            <div class="kegiatan-card">
                                <div class="kegiatan-image"
                                    style="background-image: url('../images/pembangunan_1.jpg');">
                                </div>
                                <div class="kegiatan-content">
                                    <h3 class="mt-3">Pembangunan</h3>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam, obcaecati.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="kegiatan-card">
                                <div class="kegiatan-image" style="background-image: url('../images/lomba.jpg');">
                                </div>
                                <div class="kegiatan-content">
                                    <h3 class="mt-3">Perlombaan</h3>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam, obcaecati.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="kegiatan-card">
                                <div class="kegiatan-image" style="background-image: url('../images/umkm.jpg');">
                                </div>
                                <div class="kegiatan-content">
                                    <h3 class="mt-3">UMKM</h3>
                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aperiam, obcaecati.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Layanan --}}
        <section id="layanan" class="py-5" style="background-color: #f3f3f3;">
            <div class="container" style="margin-bottom: 100px;margin-top: 40px;margin-bottom:120px">
                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-uppercase mb-3">Layanan Masyarakat</h2>
                        <p class="text-muted">Layanan yang disediakan oleh pemerintah kelurahan Atang Senjaya.</p>
                    </div>
                </div>
                <div class="service-container">
                    <div class="service-wrapper">
                        <div class="service-item">
                            <a href="#">
                                <div class="service-icon">
                                    <i class="far fa-comments"></i>
                                </div>
                            </a>
                            <h4>Layanan 1</h4>
                        </div>
                        <div class="service-item">
                            <a href="/pengajuansurat">
                                <div class="service-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </a>
                            <h4>Layanan 2</h4>
                        </div>

                        <div class="service-item">
                            <a href="/kontak">
                                <div class="service-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </a>
                            <h4>Layanan 3</h4>
                        </div>

                        <div class="service-item">
                            <a href="/pengumuman">
                                <div class="service-icon">
                                    <i class="fa fa-bullhorn"></i>
                                </div>
                            </a>
                            <h4>Layanan 4</h4>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
        {{-- News Section --}}
        <section id="berita" class="py-5 px-5" style="background-color: #5a5a5a;">
            <div class="container" style="margin-bottom: 100px;margin-top: 25px;">
                <div class="row mb-5">
                    <div class="col-lg-6 mx-auto text-center">
                        <h2 class="text-white text-uppercase mb-3">Berita Kelurahan</h2>
                        <p class="text-light" style="margin-top: 10px;">Berbagai berita terkini dan kejadian yang ada
                            di
                            kelurahan Atang Senjaya.</p>
                    </div>
                </div>
                <div class="row" style="margin-top: -25px;">
                    @foreach ($latestNews as $news)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="news-card">
                                <img src="{{ Storage::url('news/' . $news->image) }}" alt="{{ $news->title }}"
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-date">{{ $news->created_at->format('d M Y') }}</p>
                                    <h5 class="card-title">{{ $news->title }}</h5>
                                    <p class="card-text">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                                    <a href="{{ route('news.user.show', $news->slug) }}" class="btn-read-more">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- More News Card --}}
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="news-card more-news">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h4 class="text-center mb-4">Baca Berita Lainnya</h4>
                                <a href="{{ route('news.list') }}" class="btn-more-news">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="lokasi" class="py-5" style="overflow-y:hidden; background-color:#f3f3f3">
            <div class="container" style="margin-bottom: 100px;margin-top: 25px">
                <div class="row mb-4">
                    <div class="col-lg-6 mx-auto text-center">
                        <h2 class="text-uppercase mb-3">Lokasi Kelurahan Atang Senjaya</h2>
                        <p class="text-muted">Temukan Lokasi Kelurahan Atang Senjaya pada alamat dibawah</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="lokasi-wrapper" style="height: 425px;">
                            <div class="map-container">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5230.280747357531!2d106.76030606579751!3d-6.5454513933678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c37c2f09f6df%3A0x375e417fb99248e!2sKantor%20Kelurahan%20Atang%20Senjaya!5e0!3m2!1sid!2sid!4v1735181793208!5m2!1sid!2sid"
                                    width="800" height="425" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="batas-wilayah mb-4">
                            <h3>Batas Wilayah</h3>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-chevron-right me-2"></i><strong>Barat:</strong> Batas 1
                                </li>
                                <li><i class="fas fa-chevron-right me-2"></i><strong>Utara:</strong> Batas 2</li>
                                <li><i class="fas fa-chevron-right me-2"></i><strong>Selatan:</strong> Batas 3
                                </li>
                                <li><i class="fas fa-chevron-right me-2"></i><strong>Timur:</strong> Batas 4</li>
                            </ul>
                        </div>
                        <div class="alamat-desa mb-4">
                            <h3>Kantor Kelurahan Atang Senjaya</h3>
                            <p><i class="fas fa-map-marker-alt me-2"></i>FQ47+9M Atang Senjaya, Kabupaten Bogor, Jawa
                                Barat
                                16310</p>
                            <p><i class="fas fa-map me-2"></i>6°32'38.4"S 106°45'50.9"E</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="py-3" style="color: rgb(255,255,255); background: #041d2d;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="copyright">Copyright © Kelurahan Atang Senjaya 2024</span>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script type="module"
            src="https://ajax.googleapis.com/ajax/libs/@googlemaps/extended-component-library/0.6.11/index.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const navbar = document.querySelector('.navbar');

                const handleScroll = () => {
                    if (window.scrollY > 20) {
                        navbar.classList.add('navbar-scrolled');
                    } else {
                        navbar.classList.remove('navbar-scrolled');
                    }
                };

                window.addEventListener('scroll', handleScroll);
                // Panggil sekali saat halaman dimuat untuk menangani refresh di tengah halaman
                handleScroll();
            });
            document.addEventListener('DOMContentLoaded', init);
        </script>
    </body>

</html>
