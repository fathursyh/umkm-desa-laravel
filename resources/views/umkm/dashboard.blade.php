
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">UMKM Dashboard</h4>
                    {{-- <a href="{{ route('submissions.create') }}" class="btn btn-primary">
                        <i class="ri-add-line"></i> New Submission
                    </a> --}}
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Submissions</h5>
                                    <h3>{{ $user->submissions()->count() }}/10</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Approved</h5>
                                    <h3>{{ $user->submissions()->where('status', 'approved')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Pending</h5>
                                    <h3>{{ $user->submissions()->where('status', 'pending')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>Recent Submissions</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>UMKM Name</th>
                                    <th>Business Type</th>
                                    <th>Status</th>
                                    <th>Submission Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                <tr>
                                    <td>{{ $submission->umkm_name }}</td>
                                    <td>{{ $submission->business_type }}</td>
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
                                           class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-end mt-3">
                        <a href="{{ route('submissions.index') }}" class="btn btn-secondary">
                            View All Submissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection