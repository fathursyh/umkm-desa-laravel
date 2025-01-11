@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Kelola Berita</h4>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="ri-add-line"></i> Tambah Berita
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Judul</th>
                                <th>Dilihat</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>
                                        <img src="{{ Storage::url('news/thumbnails/' . $item->thumbnail) }}" alt="thumbnail"
                                            width="50">
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->views }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- <a href="{{ route('admin.news.show', $item->slug) }}" 
                                               class="btn btn-sm btn-info">
                                                <i class="ri-eye-line"></i> Lihat
                                            </a> --}}
                                            <a href="{{ route('admin.news.edit', $item) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="ri-pencil-line"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $item) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                                    <i class="ri-delete-bin-line"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        .btn-group .btn {
            margin-right: 4px;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
    @endpush
@endsection