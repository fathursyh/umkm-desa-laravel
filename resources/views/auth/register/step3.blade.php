@extends('layouts.app')

@section('title', 'Register - Step 3')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="progress mb-4" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%">
                            Step 3 of 4 - Daftarkan Produk
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register.step3.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div id="products-container">
                            @php
                                $product_data = $errors->any() ? session()->getOldInput()['products'] : (session('product_data') ?? []);
                            @endphp

                            @forelse ($product_data as $product)
                                <div class="product-item mb-4">
                                    <div class="border rounded p-3 mb-3">
                                        @if (!$loop->first)
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="mb-0">Product #{{ $loop->index }}</h5>
                                                <button type="button" class="btn btn-danger btn-sm remove-product">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        @else
                                            <h5 class="mb-3">Produk #{{ $loop->index }}</h5>
                                        @endif
                                        <div class="mb-3">
                                            <label for="product_name_{{ $loop->index }}" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control @error("products.{$loop->index}.name") is-invalid @enderror" 
                                                id="product_name_{{ $loop->index }}" name="products[{{ $loop->index }}][name]" value="{{ $product['name'] }}" required>
                                            @error("products.{$loop->index}.name")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="product_description_{{ $loop->index }}">Deskripsi Produk</label>
                                            <textarea class="form-control @error("products.{$loop->index}.description") is-invalid @enderror" id="product_description_{{ $loop->index }}" name="products[{{ $loop->index }}][description]" rows="4" required>{{ $product['description'] }}</textarea>
                                            @error("products.{$loop->index}.description")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product_images_{{ $loop->index }}" class="form-label">Foto Produk</label>
                                            <input type="file" class="form-control @error("products.{$loop->index}.images") is-invalid @enderror" 
                                                id="product_images_{{ $loop->index }}" name="products[{{ $loop->index }}][images][]" accept="image/*" multiple required>
                                            <div class="form-text">Kamu bisa pilih beberapa foto (JPG, PNG, JPEG)</div>
                                            @error("products.{$loop->index}.images.*")
                                                @foreach ($errors->get("products.{$loop->index}.images.*") as $errorMessages)
                                                    @foreach ($errorMessages as $error)
                                                        <p class="text-danger">{{ $error }}</p>
                                                    @endforeach
                                                @endforeach
                                            @enderror

                                            @php
                                                if (!$errors->any()) {
                                                    foreach ($product['images'] as $image) {
                                                        \Illuminate\Support\Facades\Storage::disk('public')->delete($image);
                                                    }
                                                }
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="product-item mb-4">
                                    <div class="border rounded p-3 mb-3">
                                        <h5 class="mb-3">Produk #1</h5>
                                        <div class="mb-3">
                                            <label for="product_name_0" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" 
                                                id="product_name_0" name="products[0][name]" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="product_description_0">Deskripsi Produk</label>
                                            <textarea class="form-control" id="product_description_0" name="products[0][description]" rows="4" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="product_images_0" class="form-label">Foto Produk</label>
                                            <input type="file" class="form-control" 
                                                id="product_images_0" name="products[0][images][]" accept="image/*" multiple required>
                                            <div class="form-text">Kamu bisa pilih beberapa foto (JPG, PNG, JPEG)</div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="mb-4">
                            <button type="button" class="btn btn-success w-100" id="add-product">
                                <i class="ri-add-line"></i> Tambah Produk Lain
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('register.step2') }}" class="btn btn-secondary">Sebelumnya</a>
                            <button type="submit" class="btn btn-primary">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let productCount = 1;
        const container = document.getElementById('products-container');
        const addButton = document.getElementById('add-product');

        addButton.addEventListener('click', function() {
            const newProduct = `
                <div class="product-item mb-4">
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Product #${productCount + 1}</h5>
                            <button type="button" class="btn btn-danger btn-sm remove-product">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="product_name_${productCount}" class="form-label">Product Name</label>
                            <input type="text" class="form-control" 
                                id="product_name_${productCount}" 
                                name="products[${productCount}][name]" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="product_description_${productCount}">Deskripsi Produk</label>
                            <textarea class="form-control" id="product_description_${productCount}" name="products[${productCount}][description]" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="product_images_${productCount}" class="form-label">Product Images</label>
                            <input type="file" class="form-control" 
                                id="product_images_${productCount}" 
                                name="products[${productCount}][images][]" 
                                accept="image/*" multiple required>
                            <div class="form-text">You can select multiple images (JPG, PNG, JPEG)</div>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', newProduct);
            productCount++;
        });

        // Handle remove product
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-product')) {
                e.target.closest('.product-item').remove();
            }
        });
    });
</script>
@endpush
@endsection