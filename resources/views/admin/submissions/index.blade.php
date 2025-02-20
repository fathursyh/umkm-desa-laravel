@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Submission Management</h4>
                    </div>
                    <div class="card-body">
                        <!-- Stats Row -->
                        
                        <!-- Filters -->
                        <form action="{{ route('admin.submissions.index') }}" method="GET" class="mb-4">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label">Filter by Status</label>
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                        <option value="revision" {{ request('status') == 'revision' ? 'selected' : '' }}>
                                            Needs Revision</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- Submissions Table -->
                        @include('admin.submissions._table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
