@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Create Submission</div>
        <div class="card-body">
            <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label>UMKM Name</label>
                    <input type="text" name="umkm_name" class="form-control" required value="{{ $umkm->name }}" {{ $umkm->name !== null ? 'disabled' : null }}>
                </div>

                <div class="mb-3">
                    <label>Establishment Date</label>
                    <input type="date" name="establishment_date" class="form-control" >
                </div>

                <div class="mb-3">
                    <label>Business Type</label>
                    <input type="text" name="business_type" class="form-control" required value="{{ $umkm->jenis_usaha }}" {{ $umkm->jenis_usaha !== null ? 'disabled' : null }}>
                </div>

                <div class="mb-3">
                    <label>Application Letter (PDF)</label>
                    <input type="file" name="application_letter" class="form-control" accept=".pdf" >
                </div>

                <div class="mb-3">
                    <label>RAB Document (PDF)</label>
                    <input type="file" name="rab_document" class="form-control" accept=".pdf" >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
