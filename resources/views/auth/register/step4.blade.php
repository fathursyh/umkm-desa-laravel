@extends('layouts.app')

@section('title', 'Register - Step 4')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="progress mb-4" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%">
                            Step 4 of 4 - RT Letter
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register.step4.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="rt_letter" class="form-label">RT Recommendation Letter (PDF)</label>
                            <input type="file" class="form-control @error('rt_letter') is-invalid @enderror" 
                                id="rt_letter" name="rt_letter" accept=".pdf" required>
                            <div class="form-text">Please upload the RT recommendation letter in PDF format (max 2MB)</div>
                            @error('rt_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('register.step3') }}" class="btn btn-secondary">Previous</a>
                            <button type="submit" class="btn btn-success">Complete Registration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection