@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Data Jurusan</h3>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Jurusan
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Jurusan</h5>
                </div>
                <div class="card-body">
                    @if($jurusan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Jurusan</th>
                                    <th>Nama Jurusan</th>
                                    <th>Jumlah Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jurusan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_jurusan ?? '-' }}</td>
                                    <td>{{ $item->nama_jurusan ?? '-' }}</td>
                                    <td><span class="badge badge-primary">{{ $item->kelas_count }}</span></td>
                                    <td>
                                        <div class="btn-group" role="group" style="gap: 5px;">
                                            <a href="{{ route('admin.jurusan.edit', $item->id) }}" class="btn btn-primary" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;"><i class="fas fa-edit me-2"></i>Edit</a>
                                            <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-delete-message="Apakah Anda yakin ingin menghapus jurusan <strong>{{ $item->nama_jurusan }}</strong>? Tindakan ini tidak dapat dibatalkan." style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;"><i class="fas fa-trash me-2"></i>Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada data jurusan
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
