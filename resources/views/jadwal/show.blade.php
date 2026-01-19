@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detail Jadwal Konseling</h2>
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Siswa</h6>
                            <p class="mb-3">{{ $jadwal->siswa->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Guru BK</h6>
                            <p class="mb-3">{{ $jadwal->guru->nama ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Tanggal & Waktu</h6>
                            <p class="mb-3">
                                {{ $jadwal->jadwal_datetime ? \Carbon\Carbon::parse($jadwal->jadwal_datetime)->format('d/m/Y H:i') : '-' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Metode</h6>
                            <p class="mb-3">
                                <span class="badge bg-{{ $jadwal->metode === 'online' ? 'info' : 'secondary' }}">
                                    {{ ucfirst($jadwal->metode) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Lokasi</h6>
                            <p class="mb-3">{{ $jadwal->lokasi ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Status</h6>
                            <p class="mb-3">
                                @if($jadwal->status === 'diajukan')
                                    <span class="badge bg-warning">Diajukan</span>
                                @elseif($jadwal->status === 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($jadwal->status === 'batal')
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($jadwal->approved_by)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Disetujui Oleh</h6>
                                <p class="mb-3">{{ $jadwal->approvedBy->name ?? '-' }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex gap-2 mt-4">
                        @if($jadwal->status !== 'batal' && auth()->user()->hasRole('siswa'))
                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus jadwal ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                        @if($jadwal->status === 'diajukan' && auth()->user()->hasRole('guru'))
                            <form action="{{ route('jadwal.approve', $jadwal->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
