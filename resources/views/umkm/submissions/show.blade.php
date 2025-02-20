@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Submission Details</h4>
            <a href="{{ route('submissions.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">UMKM Information</h5>
                    <table class="table">
                        <tr>
                            <th width="200">Nama UMKM</th>
                            <td>{{ $submission->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Usaha</th>
                            <td>{{ $submission->user->jenis_usaha ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Berdiri</th>
                            <td>{{ $submission->user->tahun_berdiri ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $submission->user->deskripsi ?? "-" }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : 
                                    ($submission->status == 'approved' ? 'success' : 
                                    ($submission->status == 'revision' ? 'info' : 'danger')) }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Submission Date</th>
                            <td>{{ $submission->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>

                    <h5 class="mb-3 mt-4">Documents</h5>
                    <div class="mb-3">
                        <label class="form-label">Application Letter</label>
                        <div>
                            <a href="{{ Storage::url($submission->application_letter) }}" 
                               class="btn btn-sm btn-primary" target="_blank">
                                <i class="ri-file-text-line me-1"></i> View Document
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RAB Document</label>
                        <div>
                            <a href="{{ Storage::url($submission->rab_document) }}" 
                               class="btn btn-sm btn-primary" target="_blank">
                                <i class="ri-file-text-line me-1"></i> View Document
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    @if($submission->admin_notes)
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Admin Response</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $submission->admin_notes }}</p>
                            <small class="text-muted">
                                Last updated: {{ $submission->updated_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>
                    @endif

                    @if($submission->status === 'revision')
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Revision Requested</h6>
                        <p class="mb-0">Please review the admin notes above and submit a new application.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection