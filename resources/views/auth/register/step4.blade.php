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
                            Step 4 of 4 - Surat Pengantar RT/RW
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register.step4.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nnib" class="form-label">Upload Nomor Induk Berusaha (PDF)</label>
                            <input type="file" class="form-control @error('nib') is-invalid @enderror" 
                                id="nib" name="nib" accept=".pdf" required>
                            <div class="form-text">Maksimal ukuran file: 2MB</div>
                            @error('nib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="surat_pengantar" class="form-label">Upload Surat Pengantar RT/RW (PDF)</label>
                            <input type="file" class="form-control @error('surat_pengantar') is-invalid @enderror" 
                                id="surat_pengantar" name="surat_pengantar" accept=".pdf" required>
                            <div class="form-text">Upload Surat Pengantar dalam format PDF (max 2MB)</div>
                            @error('surat_pengantar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('register.step3') }}" class="btn btn-secondary">Sebelumnya</a>
                            <button type="submit" class="btn btn-success">Selesai dan Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection