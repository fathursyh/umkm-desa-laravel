@extends('layouts.app')

@section('title', 'Register - Step 2')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="progress mb-4" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%">
                                Step 2 of 4 - Business Certificate
                            </div>
                        </div>

                        <form method="POST" action="{{ route('register.step2.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="business_certificate" class="form-label">Upload Business Certificate (PDF)</label>
                                <input type="file" class="form-control @error('business_certificate') is-invalid @enderror" 
                                    id="business_certificate" name="business_certificate" accept=".pdf" required>
                                <div class="form-text">Maximum file size: 2MB</div>
                                @error('business_certificate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('register.step1') }}" class="btn btn-secondary">Previous</a>
                                <button type="submit" class="btn btn-primary">Next Step</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection