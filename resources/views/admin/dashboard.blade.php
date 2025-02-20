@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Admin Dashboard</h4>
                </div>
                <div class="card-body">
                    <!-- Stats Row -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5>Total Submissions</h5>
                                    <h3>{{ $total }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5>Approved</h5>
                                    <h3>{{ $approved }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5>Pending</h5>
                                    <h3>{{ $pending }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5>Rejected</h5>
                                    <h3>{{ $rejected }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Submissions -->
                    <h5 class="mb-3">Recent Submissions</h5>
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
                                    <td>{{ $submission->user->name }}</td>
                                    <td>{{ $submission->user->jenis_usaha ?? "-" }}</td>
                                    <td>
                                        <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : 
                                            ($submission->status == 'approved' ? 'success' : 
                                            ($submission->status == 'revision' ? 'info' : 'danger')) }}">
                                            {{ ucfirst($submission->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $submission->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.submissions.show', $submission) }}" 
                                           class="btn btn-sm btn-info">View Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('admin.submissions.index') }}" class="btn btn-primary">
                            View All Submissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection