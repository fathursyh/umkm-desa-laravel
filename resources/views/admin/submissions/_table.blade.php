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