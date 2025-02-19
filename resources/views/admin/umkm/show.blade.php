
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">UMKM Details</h4>
            <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Basic Information</h5>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td>{{ $umkm->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $umkm->email }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $umkm->status == 'pending' ? 'warning' : ($umkm->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($umkm->status) }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <h5>Documents</h5>
                    <div class="mb-3">
                        <label class="form-label">NIB</label>
                        <div>
                            <a href="{{ Storage::url($umkm->nib) }}" class="btn btn-sm btn-primary" target="_blank">
                                Lihat Dokumen
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Surat Pengantar</label>
                        <div>
                            <a href="{{ Storage::url($umkm->surat_pengantar) }}" class="btn btn-sm btn-primary" target="_blank">
                                Lihat Surat
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h5>Produk</h5>
                    @foreach($umkm->products as $product)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6>{{ $product->name }}</h6>
                            <div class="row">
                                @foreach($product->images as $image)
                                <div class="col-4 mb-2">
                                    <img src="{{ Storage::url($image->image_path) }}" class="img-fluid rounded">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @if($umkm->status == 'pending')
            <div class="row mt-4">
                <div class="col-md-6">
                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve UMKM</button>
                    </form>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        Reject UMKM
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Reject UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Alasan</label>
                        <textarea class="form-control" name="rejection_reason" rows="3" required></textarea>
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