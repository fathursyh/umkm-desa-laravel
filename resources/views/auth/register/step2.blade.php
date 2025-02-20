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
                                Step 2 of 4 - Upload NIB UMKM
                            </div>
                        </div>

                        
                        <form method="POST" action="{{ route('register.step2.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                                <select name="jenis_usaha" id="jenis_usaha" class="form-control @error('deskripsi') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Usaha --</option>
                                    @foreach ($jenis_usaha as $usaha)
                                        <option value="{{ $usaha }}" @if (is_array(session('registration_data')) ? session('registration_data')['jenis_usaha'] : null) selected @endif>{{ $usaha }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Usaha</label>
                                <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" 
                                    id="deskripsi" name="deskripsi" required>{{ old('deskripsi', is_array(session('registration_data')) ? session('registration_data')['deskripsi'] : null) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                                <input type="number" maxlength="4" class="form-control @error('tahun_berdiri') is-invalid @enderror" 
                                    id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', is_array(session('registration_data')) ? session('registration_data')['tahun_berdiri'] : null) }}" 
                                    oninput="this.value=this.value.slice(0,4)" required>
                                @error('tahun_berdiri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_karyawan" class="form-label">Jumlah Karyawan</label>
                                <input type="number" class="form-control @error('jumlah_karyawan') is-invalid @enderror" 
                                    id="jumlah_karyawan" name="jumlah_karyawan" value="{{ old('jumlah_karyawan', is_array(session('registration_data')) ? session('registration_data')['jumlah_karyawan'] : null) }}" required>
                                </select>
                                @error('jumlah_karyawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                                <input type="text" class="form-control @error('alamat_usaha') is-invalid @enderror" 
                                    id="alamat_usaha" name="alamat_usaha" value="{{ old('alamat_usaha', is_array(session('registration_data')) ? session('registration_data')['alamat_usaha'] : null) }}" required>
                                @error('alamat_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('register.step1') }}" class="btn btn-secondary">Sebelumnya</a>
                                <button type="submit" class="btn btn-primary">Selanjutnya</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection