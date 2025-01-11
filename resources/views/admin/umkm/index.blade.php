@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">UMKM Management</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($umkm_users as $umkm)
                        <tr>
                            <td>{{ $umkm->name }}</td>
                            <td>{{ $umkm->email }}</td>
                            <td>
                                <span class="badge bg-{{ $umkm->status == 'pending' ? 'warning' : ($umkm->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($umkm->status) }}
                                </span>
                            </td>
                            <td>{{ $umkm->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.umkm.show', $umkm->id) }}" class="btn btn-sm btn-info">View</a>
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