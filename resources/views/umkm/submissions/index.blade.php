@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">My Submissions</h4>
            <a href="{{ route('submissions.create') }}" class="btn btn-primary">
                <i class="ri-add-line"></i> New Submission
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>UMKM Name</th>
                            <th>Business Type</th>
                            <th>Tahun Berdiri</th>
                            <th>Status</th>
                            <th>Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->user->name }}</td>
                            <td>{{ $submission->user->jenis_usaha ?? "-" }}</td>
                            <td>{{ $submission->user->tahun_berdiri ?? "-" }}</td>
                            <td>
                                <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : 
                                    ($submission->status == 'approved' ? 'success' : 
                                    ($submission->status == 'revision' ? 'info' : 'danger')) }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td>{{ $submission->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('submissions.show', $submission) }}" 
                                   class="btn btn-sm btn-info">View Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection