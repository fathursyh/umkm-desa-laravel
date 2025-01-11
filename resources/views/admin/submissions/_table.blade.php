<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>UMKM Name</th>
                <th>Business Type</th>
                <th>Age</th>
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
                <td>{{ $submission->umkm_age }}</td>
                <td>
                    <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : 
                        ($submission->status == 'approved' ? 'success' : 'danger') }}">
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

    <div class="mt-4">
        {{ $submissions->links() }}
    </div>
</div>