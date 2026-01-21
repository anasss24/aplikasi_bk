@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Data Siswa</h1>
                    <p class="text-muted mb-0">Kelola data siswa sekolah</p>
                </div>
                <a href="/admin/siswa/create" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Siswa
                </a>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-dark fw-bold">No</th>
                                <th class="text-dark fw-bold">NISN</th>
                                <th class="text-dark fw-bold">Nama Siswa</th>
                                <th class="text-dark fw-bold">Kelas</th>
                                <th class="text-dark fw-bold">Jenis Kelamin</th>
                                <th class="text-dark fw-bold">No. Telepon</th>
                                <th class="text-dark fw-bold">Email</th>
                                <th class="text-dark fw-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($siswa->count() > 0)
                                @foreach($siswa as $item)
                                <tr class="border-bottom">
                                    <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $item->nisn }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="mb-1 fw-bold">{{ $item->nama_siswa }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->kelas)
                                            <span class="badge bg-info text-dark">{{ $item->kelas->nama_kelas }}</span>
                                        @else
                                            <span class="badge bg-light text-dark">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->jenis_kelamin === 'laki-laki')
                                            <span><i class="fas fa-mars text-primary me-1"></i>Laki-laki</span>
                                        @else
                                            <span><i class="fas fa-venus text-danger me-1"></i>Perempuan</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->no_telepon ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" style="gap: 5px;">
                                            <a href="/admin/siswa/{{ $item->id }}/edit" class="btn btn-primary btn-sm" title="Edit" style="width: 36px; height: 36px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="/admin/siswa/{{ $item->id }}" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" data-delete-message="Apakah Anda yakin ingin menghapus data <strong>{{ $item->nama_siswa }}</strong>? Tindakan ini tidak dapat dibatalkan." style="width: 36px; height: 36px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>


                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                            <p class="mb-0">Belum ada data siswa</p>
                                            <small>Klik tombol "Tambah Siswa" untuk menambahkan data baru</small>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
