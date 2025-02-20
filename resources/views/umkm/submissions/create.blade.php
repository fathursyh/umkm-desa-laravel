@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Pengajuan Baru</div>
        <div class="card-body">
            @if ($submition_count)
                <div class="alert alert-warning" role="alert">
                    Anda sudah mengirim lebih dari 10 submission! Tidak bisa mengirim lagi
                </div>
            @endif
            <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tujuan">Tujuan Pengajuan</label>
                    <input id="tujuan" type="text" @if ($submition_count) disabled @endif name="tujuan_pengajuan" class="form-control" required value="{{ @old('tujuan_pengajuan') }}" placeholder="Tujuan pengajuan" autofocus>
                    @error('tujuan_pengajuan')
                    <p class="text-danger text-sm ms-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pendapatan">Pendapatan Bulanan (Rp)</label>
                    <input id="pendapatan" type="number" @if ($submition_count) disabled @endif name="pendapatan_bulan" class="form-control" value="{{ @old('pendapatan_bulan') }}" placeholder="Contoh : 1000000" required>
                    @error('pendapatan_bulan')
                    <p class="text-danger text-sm ms-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="application">Application Letter (PDF)</label>
                    <input id="application" type="file" @if ($submition_count) disabled @endif name="application_letter" class="form-control" accept=".pdf" required>
                    @error('application_letter')
                    <p class="text-danger text-sm ms-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rab">RAB Document (PDF)</label>
                    <input id="rab" type="file" @if ($submition_count) disabled @endif name="rab_document" class="form-control" accept=".pdf" required>
                    @error('rab_document')
                    <p class="text-danger text-sm ms-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" @if ($submition_count) disabled @endif class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
