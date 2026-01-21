@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Detail Siswa</h2>
            <p class="text-muted">Informasi lengkap siswa</p>
        </div>
        <div class="col-md-4 text-end">
            @if((Auth::user()->role ?? null) === 'admin' || (Auth::user()->role ?? null) === 'guru_bk')
            <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            @endif
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Info Singkat -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Informasi Singkat</h6>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <small class="text-muted d-block">Nama Siswa</small>
                        <strong>{{ $siswa->nama_siswa }}</strong>
                    </div>
                    <div class="list-group-item">
                        <small class="text-muted d-block">Jenis Kelamin</small>
                        <strong>{{ $siswa->jenis_kelamin }}</strong>
                    </div>
                    <div class="list-group-item">
                        <small class="text-muted d-block">Kelas</small>
                        <strong>{{ $siswa->kelas->nama_kelas ?? '-' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Detail Lengkap -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Data Pribadi</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">NIS</label>
                            <p class="mb-0">{{ $siswa->nis }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">NISN</label>
                            <p class="mb-0">{{ $siswa->nisn ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted small">Tempat Lahir</label>
                            <p class="mb-0">{{ $siswa->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Tanggal Lahir</label>
                            <p class="mb-0">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d F Y') : '-' }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small">Alamat</label>
                        <p class="mb-0">{{ $siswa->alamat ?? '-' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted small">No. Telepon</label>
                            <p class="mb-0">{{ $siswa->no_telepon ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0">{{ $siswa->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Aktivitas -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Riwayat Sistem</h6>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <small class="text-muted">Dibuat</small>
                        <p class="mb-0">{{ $siswa->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div class="list-group-item">
                        <small class="text-muted">Diperbarui</small>
                        <p class="mb-0">{{ $siswa->updated_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .list-group-item {
        padding: 1rem;
    }
    .list-group-item small {
        display: block;
        margin-bottom: 0.25rem;
    }
    .list-group-item p {
        margin-bottom: 0;
    }
</style>
@endsection
