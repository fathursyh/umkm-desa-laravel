@extends('layouts.profil')

@section('title', 'Tentang')

@section('content')
    <div class="content">
        <section class="bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="lurah.jpg" alt="Foto Ketua Lurah" class="img-fluid rounded-circle shadow">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-4 fw-bold">Sambutan Lurah Atang Senjaya</h2>
                        <p>Assalamu'alaikum warahmatullahi wabarakatuh,</p>
                        <p>
                            Dengan rahmat Tuhan Yang Maha Esa, kami menyampaikan rasa syukur atas kepercayaan yang diberikan
                            kepada kami dalam melayani masyarakat. Sebagai lurah, saya berkomitmen untuk menjalankan tugas dengan penuh
                            dedikasi dan transparansi, demi menciptakan lingkungan yang lebih baik bagi kita semua.
                        </p>
                        <p>
                            Mari bersama-sama kita wujudkan visi dan misi untuk membangun masyarakat yang harmonis, aman, dan
                            sejahtera. Kami juga terbuka untuk kritik dan saran dari seluruh warga demi perbaikan yang
                            berkelanjutan.
                        </p>
                        <p>
                            Wassalamu'alaikum warahmatullahi wabarakatuh.
                        </p>
                        <p>
                            Hormat kami,<br>
                            <strong>Hendra Cipta S.Sos</strong>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-dark py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8 order-md-2">
                        <h2 class="mb-4 text-white">Sejarah</h2>
                        <p class="text-white">
                            Kelurahan Atang Senjaya berdiri sejak tahun 1980-an sebagai bagian dari pengembangan wilayah Kabupaten Bogor. 
                            Sejak awal, kelurahan ini memiliki visi untuk menjadi lingkungan yang harmonis dan dinamis dengan penduduk yang aktif 
                            dalam pembangunan wilayah.
                        </p>
                        <p class="text-white">
                            Berbagai program telah dilaksanakan untuk meningkatkan kesejahteraan masyarakat, mulai dari pembangunan infrastruktur 
                            hingga kegiatan sosial. Dengan semangat gotong royong, kelurahan ini terus berkembang menjadi salah satu wilayah yang 
                            dikenal dengan kekompakan dan inovasinya.
                        </p>
                    </div>
                    <div class="col-md-4 order-md-1 text-center mb-4 mb-md-0">
                        <img src="{{asset('images/container.jpg')}}" alt="Foto Sejarah Kelurahan" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="content">
        <section id="visimisi" style="padding-top: 90px; padding-bottom: 90px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="vision-content text-center p-4 mb-5"
                            style="background: linear-gradient(135deg, #072e48, #0a4c7a); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <h3 class="text-white mb-4">Visi</h3>
                            <p class="text-light" style="font-size: 1.2rem;">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias rerum facere placeat quod maxime ut, harum officiis dolorum perspiciatis ipsam.
                            </p>
                        </div>
                        <div class="mission-content p-4"
                            style="background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                            <h3 class="text-center mb-4" style="color: #072e48;">Misi</h3>
                            <ul style="list-style-type: none; padding-left: 0;">
                                <li class="mb-3"><i class="fas fa-check-circle mr-2" style="color: #0a4c7a;"></i>
                                    Mengembangkan infrastruktur digital untuk meningkatkan kualitas hidup masyarakat</li>
                                <li class="mb-3"><i class="fas fa-check-circle mr-2" style="color: #0a4c7a;"></i>
                                    Mempromosikan ekonomi kreatif berbasis teknologi dan kearifan lokal</li>
                                <li class="mb-3"><i class="fas fa-check-circle mr-2" style="color: #0a4c7a;"></i>
                                    Meningkatkan pelayanan publik melalui sistem pemerintahan yang transparan dan efisien
                                </li>
                                <li class="mb-3"><i class="fas fa-check-circle mr-2" style="color: #0a4c7a;"></i>
                                    Melestarikan lingkungan hidup dengan menerapkan solusi ramah lingkungan</li>
                                <li><i class="fas fa-check-circle mr-2" style="color: #0a4c7a;"></i> Mengembangkan sumber
                                    daya manusia yang berdaya saing global namun tetap berpegang pada nilai-nilai lokal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="py-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="copyright">Copyright © Kelurahan Atang Senjaya 2024</span>
                </div>
            </div>
        </div>
    </footer>
@endsection
