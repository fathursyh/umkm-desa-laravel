@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Submission Details</h4>
            <a href="{{ route('admin.submissions.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>UMKM Information</h5>
                    <table class="table">
                        <tr>
                            <th>Nama UMKM</th>
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
                    </table>

                    <h5>Documents</h5>
                    <div class="mb-3">
                        <label class="form-label">Application Letter</label>
                        <div>
                            <a href="{{ Storage::url($submission->application_letter) }}" 
                               class="btn btn-sm btn-primary" target="_blank">
                                View Document
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">RAB Document</label>
                        <div>
                            <a href="{{ Storage::url($submission->rab_document) }}" 
                               class="btn btn-sm btn-primary" target="_blank">
                                View Document
                            </a>
                        </div>
                    </div>
                </div>

                @if($submission->status == 'pending')
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Actions</h5>
                            <form action="{{ route('admin.submissions.approve', $submission) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>

                            <button type="button" class="btn btn-warning" 
                                    data-bs-toggle="modal" data-bs-target="#revisionModal">
                                Request Revision
                            </button>

                            <button type="button" class="btn btn-danger" 
                                    data-bs-toggle="modal" data-bs-target="#rejectModal">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Revision Modal -->
<div class="modal fade" id="revisionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.submissions.revision', $submission) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Request Revision</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Revision Notes</label>
                        <textarea class="form-control" name="admin_notes" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Request Revision</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.submissions.reject', $submission) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Reject Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Reason for Rejection</label>
                        <textarea class="form-control" name="admin_notes" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection