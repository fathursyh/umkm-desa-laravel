@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Berita</h4>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="title" class="form-control" 
                           value="{{ old('title', $news->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" id="editor" class="form-control" 
                              rows="10" required>{{ old('content', $news->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Gambar Saat Ini</label>
                    <div class="mb-2">
                        <img src="{{ Storage::url('news/'.$news->image) }}" 
                             alt="Current Image" class="img-thumbnail" width="200">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection