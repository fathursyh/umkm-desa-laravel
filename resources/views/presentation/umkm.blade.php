@extends('layouts.landing')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4"></h2>
                <h2 class="text-center mb-4">UMKM</h2>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="news-container">
                    @foreach ($umkm as $user)
                        <div class="col">
                            <div class="card h-100 news-item">
                                <div class="card-img-wrapper">
                                    <img src="https://ikpi.or.id/wp-content/uploads/2024/12/d0bd99163261318d5675e320af42c52d.jpeg" class="card-img-top" alt="">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{$user->name}}</h5>
                                    <p class="card-text flex-grow-1">{{$user->deskripsi}}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('umkm.lihat', $user->id) }}" class="btn btn-primary">
                                            Lihat Produk
                                        </a>
                                        <div class="share-buttons">
                                            <a href="" class="btn btn-success btn-sm" target="_blank">
                                                <i class="ri-whatsapp-line"></i>
                                            </a>
                                            <a href="" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="ri-facebook-circle-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Loading Spinner -->
                <div id="loading-spinner" class="text-center my-4 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .card-img-wrapper {
                height: 200px;
                overflow: hidden;
            }

            .card-img-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .news-item {
                transition: all 0.3s ease;
                border: none;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .news-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .news-item:hover .card-img-wrapper img {
                transform: scale(1.1);
            }

            .card-title {
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .share-buttons .btn {
                padding: 0.25rem 0.5rem;
                margin-left: 0.25rem;
            }

            #load-more-btn {
                transition: all 0.3s ease;
                min-width: 200px;
            }

            #load-more-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            #load-more-btn:disabled {
                opacity: 0.7;
                cursor: not-allowed;
                transform: none;
            }

            .spinner-border {
                width: 3rem;
                height: 3rem;
            }
        </style>
    @endpush
@endsection
