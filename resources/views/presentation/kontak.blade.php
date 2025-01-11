@extends('layouts.profil')

@section('title', 'Kontak')

@section('content')
    <div class="content">
        <section id="kontak" style="background-color: #f8f9fa;">
            <div class="container" style="padding-top: 120px; padding-bottom: 140px;">
                <div class="kontak-card">
                    <div class="row g-0">
                        <div class="col-lg-6 kontak-info">
                            <h2 class="mb-4 animated-text">Hubungi Kami</h2>
                            <ul class="list-unstyled contact-list">
                                <li class="mb-3 animated-text">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <strong>Alamat:</strong><br>
                                    Atang Senjaya, Kabupaten Bogor, Jawa Barat 16310
                                </li>
                                <li class="mb-3 animated-text">
                                    <i class="fas fa-phone-alt mr-2"></i>
                                    <strong>Telepon:</strong><br>
                                    (021) 1234-5678
                                </li>
                                <li class="mb-3 animated-text">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <strong>Email:</strong><br>
                                    info@kelurahanatangsenjaya.go.id
                                </li>
                                <li class="mb-3 animated-text">
                                    <i class="fas fa-clock mr-2"></i>
                                    <strong>Jam Kerja:</strong><br>
                                    Senin - Jumat: 08.00 - 16.00 WIB
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8 kontak-image">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5230.280747357531!2d106.76030606579751!3d-6.5454513933678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c37c2f09f6df%3A0x375e417fb99248e!2sKantor%20Kelurahan%20Atang%20Senjaya!5e0!3m2!1sid!2sid!4v1735181793208!5m2!1sid!2sid"
                                width="800" height="425" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="py-3" style="color: #ffffff; background: #041d2d;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="copyright">Copyright © Desa Tegal 2024</span>
                </div>
            </div>
        </div>
    </footer>
@endsection
