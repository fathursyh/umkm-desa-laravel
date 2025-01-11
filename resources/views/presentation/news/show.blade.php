@extends('layouts.landing')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <img src="{{ Storage::url('news/'.$news->image) }}" 
                     class="card-img-top" alt="{{ $news->title }}">
                
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <small class="text-muted">
                            <i class="ri-calendar-line"></i> 
                            {{ $news->created_at->format('d M Y') }}
                        </small>
                        <small class="text-muted">
                            <i class="ri-eye-line"></i> 
                            {{ $news->views }} views
                        </small>
                    </div>

                    <h1 class="card-title mb-4">{{ $news->title }}</h1>
                    
                    <div class="content mb-4">
                        {!! $news->content !!}
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('news.list') }}" class="btn btn-secondary">
                            <i class="ri-arrow-left-line"></i> Kembali
                        </a>
                        
                        <div class="share-buttons">
                            <span class="me-2">Bagikan:</span>
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' ' . url()->current()) }}" 
                               class="btn btn-success" target="_blank">
                                <i class="ri-whatsapp-line"></i> WhatsApp
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               class="btn btn-primary" target="_blank">
                                <i class="ri-facebook-circle-line"></i> Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .content img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
    }
    .share-buttons .btn {
        margin-left: 0.5rem;
    }
</style>
@endpush
@endsection