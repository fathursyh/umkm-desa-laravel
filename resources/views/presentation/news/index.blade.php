@extends('layouts.landing')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4"></h2>
                <h2 class="text-center mb-4">Berita Terkini</h2>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="news-container">
                    @foreach ($news as $item)
                        <div class="col">
                            <div class="card h-100 news-item">
                                <div class="card-img-wrapper">
                                    <img src="{{ Storage::url('news/' . $item->image) }}" class="card-img-top"
                                        alt="{{ $item->title }}">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="text-muted">
                                            <i class="ri-calendar-line"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="ri-eye-line"></i>
                                            {{ $item->views }} views
                                        </small>
                                    </div>
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="{{ route('news.user.show', $item->slug) }}" class="btn btn-primary">
                                            Baca Selengkapnya
                                        </a>
                                        <div class="share-buttons">
                                            <a href="https://wa.me/?text={{ urlencode($item->title . ' ' . route('news.user.show', $item->slug)) }}"
                                                class="btn btn-success btn-sm" target="_blank">
                                                <i class="ri-whatsapp-line"></i>
                                            </a>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.user.show', $item->slug)) }}"
                                                class="btn btn-primary btn-sm" target="_blank">
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

                <!-- Load More Button -->
                {{-- <div class="text-center mt-4" id="load-more-container">
                    <button id="load-more-btn" class="btn btn-primary px-4">
                        <span class="button-text">Muat Lebih Banyak</span>
                        <div class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div> --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let page = 1;
            let loading = false;
            let hasMore = true;

            $('#load-more-btn').click(function() {
                loadMoreNews();
            });

            function loadMoreNews() {
                if (loading || !hasMore) return;

                loading = true;
                const btn = $('#load-more-btn');
                btn.prop('disabled', true);
                btn.find('.button-text').text('Loading...');
                btn.find('.spinner-border').removeClass('d-none');

                $.ajax({
                    url: '{{ route('news.load-more') }}',
                    method: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        if (response.news.length > 0) {
                            response.news.forEach(function(item) {
                                const newsCard = `
                            <div class="col animate__animated animate__fadeIn">
                                <div class="card h-100 news-item">
                                    <div class="card-img-wrapper">
                                        <img src="/storage/news/${item.image}" 
                                             class="card-img-top" alt="${item.title}">
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">
                                                <i class="ri-calendar-line"></i> 
                                                ${item.created_at}
                                            </small>
                                            <small class="text-muted">
                                                <i class="ri-eye-line"></i> 
                                                ${item.views} views
                                            </small>
                                        </div>
                                        <h5 class="card-title">${item.title}</h5>
                                        <p class="card-text flex-grow-1">${item.content}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <a href="/news/${item.slug}" class="btn btn-primary">
                                                Baca Selengkapnya
                                            </a>
                                            <div class="share-buttons">
                                                <a href="https://wa.me/?text=${encodeURIComponent(item.title + ' ' + window.location.origin + '/news/' + item.slug)}" 
                                                   class="btn btn-success btn-sm" target="_blank">
                                                    <i class="ri-whatsapp-line"></i>
                                                </a>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.origin + '/news/' + item.slug)}" 
                                                   class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="ri-facebook-circle-line"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                                $('#news-container').append(newsCard);
                            });

                            page++;
                            hasMore = response.hasMore;

                            if (!hasMore) {
                                $('#load-more-container').remove();
                            }
                        } else {
                            hasMore = false;
                            $('#load-more-container').remove();
                        }
                    },
                    error: function() {
                        console.error('Failed to load more news');
                    },
                    complete: function() {
                        loading = false;
                        btn.prop('disabled', false);
                        btn.find('.button-text').text('Muat Lebih Banyak');
                        btn.find('.spinner-border').addClass('d-none');
                    }
                });
            }
        </script>
    @endpush

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
