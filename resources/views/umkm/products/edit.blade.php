@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Produk</label>
            <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="images">Gambar Produk</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="form-group">
            <label>Gambar Saat Ini</label>
            <div>
                @foreach($product->images as $image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" style="width: 100px; height: auto;">
                        <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Hapus
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
