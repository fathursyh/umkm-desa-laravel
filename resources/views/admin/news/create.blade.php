@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Berita Baru</h4>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" id="createNewsForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="content" id="editor" 
                              class="form-control @error('content') is-invalid @enderror" 
                              rows="10" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" 
                           class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*" required>
                    <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary" onclick="submitForm(event)">
                        <i class="ri-save-line"></i> Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    let editor;
    
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    function submitForm(e) {
        e.preventDefault();
        
        // Get CKEditor content
        const content = editor.getData();
        
        // Set content to textarea
        document.querySelector('#editor').value = content;
        
        // Submit form
        document.getElementById('createNewsForm').submit();
    }
</script>
@endpush
@endsection