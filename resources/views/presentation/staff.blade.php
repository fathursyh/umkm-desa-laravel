@extends('layouts.profil')

@section('title', 'Staff')

@section('content')
    <div id="staff" class="content">
        <section id="strukturdesa" style="padding-top: 100px; padding-bottom: 110px; background-color: #f8f9fa;">
            <div class="container">
                <h2 class="text-center text-uppercase mb-5">Struktur Pemerintahan Kelurahan Atang Senjaya</h2>
                <div class="org-chart">
                    <div class="org-level">
                        <div class="org-unit kepala-desa">
                            <h3>Lurah</h3>
                            <p>Hendra Cipta, S.Sos</p>
                        </div>
                    </div>
                    <div class="org-level">
                        <div class="org-unit sekretaris-desa">
                            <h4>Sekretaris</h4>
                            <p>Dwi Martuti</p>
                        </div>
                    </div>
                    <div class="org-level">
                        <div class="org-unit kaur">
                            <h5>Kasi Pemerintahan</h5>
                            <p>H. Heri Sobirin, S.Pd, M.M</p>
                        </div>
                        <div class="org-unit kaur">
                            <h5>Kasi Perekonomian<br>& Pembangunan</h5>
                            <p>Hj. Ayi Hibariningsih, SE, M.Si</p>
                        </div>
                        <div class="org-unit kaur">
                            <h5>Kasi Pemberdayaan<br>Kes Masyarakat</h5>
                            <p>H. Baden, SE</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="py-3" style="color: rgb(255,255,255); background: #041d2d;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <span class="copyright">Copyright © Kelurahan Atang Senjaya 2024</span>
                </div>
            </div>
        </div>
    </footer>
@endsection
