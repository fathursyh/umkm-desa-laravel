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
                            Step 3 of 4 - Product Details
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register.step3.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div id="products-container">
                            <div class="product-item mb-4">
                                <div class="border rounded p-3 mb-3">
                                    <h5 class="mb-3">Product #1</h5>
                                    <div class="mb-3">
                                        <label for="product_name_0" class="form-label">Product Name</label>
                                        <input type="text" class="form-control @error('products.0.name') is-invalid @enderror" 
                                            id="product_name_0" name="products[0][name]" value="{{ old('products.0.name') }}" required>
                                        @error('products.0.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_images_0" class="form-label">Product Images</label>
                                        <input type="file" class="form-control @error('products.0.images') is-invalid @enderror" 
                                            id="product_images_0" name="products[0][images][]" accept="image/*" multiple required>
                                        <div class="form-text">You can select multiple images (JPG, PNG, JPEG)</div>
                                        @error('products.0.images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="button" class="btn btn-success w-100" id="add-product">
                                <i class="ri-add-line"></i> Add Another Product
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('register.step2') }}" class="btn btn-secondary">Previous</a>
                            <button type="submit" class="btn btn-primary">Next Step</button>
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