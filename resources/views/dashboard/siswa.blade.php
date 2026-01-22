@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header with Real-time Clock -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Dashboard Siswa</h1>
                    <p class="text-muted mb-0">Kelola jadwal dan riwayat konseling anda</p>
                </div>
                <div style="background: linear-gradient(135deg, #0099C9, #0077B6); padding: 15px 25px; border-radius: 10px; color: white; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 153, 201, 0.2);">
                    <i class="fas fa-calendar me-2"></i><span id="real-time-clock">--:--:--</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('jadwal.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2 fw-semibold">Jadwal Konseling</p>
                                <h3 class="fw-bold mb-0" style="color: #0099C9;">{{ $totalJadwal ?? 0 }}</h3>
                            </div>
                            <div style="width: 50px; height: 50px; background: rgba(0, 153, 201, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-calendar-check" style="color: #0099C9; font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('riwayat.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2 fw-semibold">Riwayat Konseling</p>
                                <h3 class="fw-bold mb-0" style="color: #0077B6;">{{ $totalRiwayat ?? 0 }}</h3>
                            </div>
                            <div style="width: 50px; height: 50px; background: rgba(0, 119, 182, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-history" style="color: #0077B6; font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('materi.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 hover-shadow" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2 fw-semibold">Materi Tersedia</p>
                                <h3 class="fw-bold mb-0" style="color: #0099C9;">{{ $totalMateri ?? 0 }}</h3>
                            </div>
                            <div style="width: 50px; height: 50px; background: rgba(0, 153, 201, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-book" style="color: #0099C9; font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-3 mb-4">
        <!-- Jadwal Konseling Mendatang -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">Jadwal Konseling Mendatang</h6>
                    <a href="{{ route('jadwal.index') }}" class="btn btn-sm" style="background-color: #0099C9; color: white; font-weight: 600;">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    @forelse($jadwalKonseling ?? [] as $jadwal)
                        <div class="border-bottom px-4 py-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-semibold mb-0">{{ $jadwal->guru->nama ?? 'Guru BK' }}</h6>
                                @if($jadwal->status === 'pending')
                                    <a href="{{ route('jadwal.index') }}" class="badge bg-warning" style="cursor: pointer; text-decoration: none;">Menunggu</a>
                                @elseif($jadwal->status === 'approved')
                                    <a href="{{ route('jadwal.index') }}" class="badge bg-success" style="cursor: pointer; text-decoration: none;">Disetujui</a>
                                @else
                                    <a href="{{ route('jadwal.index') }}" class="badge bg-secondary" style="cursor: pointer; text-decoration: none;">{{ $jadwal->status }}</a>
                                @endif
                            </div>
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-calendar me-1" style="color: #0099C9;"></i>
                                {{ $jadwal->jadwal_datetime->format('d M Y H:i') ?? '-' }}
                            </small>
                        </div>
                    @empty
                        <div class="px-4 py-4 text-center text-muted">
                            <p>Tidak ada jadwal konseling mendatang</p>
                            <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-primary" style="background: linear-gradient(135deg, #0099C9, #0077B6); border: none;">
                                <i class="fas fa-plus me-1"></i> Buat Jadwal
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h6 class="fw-bold mb-0">Menu Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <a href="{{ route('jadwal.create') }}" class="text-decoration-none d-block">
                                <div style="padding: 15px; background: linear-gradient(135deg, #0099C9, #0077B6); border-radius: 10px; color: white; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fas fa-calendar-plus" style="font-size: 1.5rem; display: block; margin-bottom: 8px;"></i>
                                    <small class="fw-semibold">Jadwal Konseling</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('riwayat.index') }}" class="text-decoration-none d-block">
                                <div style="padding: 15px; background: linear-gradient(135deg, #00B4D8, #0096C7); border-radius: 10px; color: white; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fas fa-history" style="font-size: 1.5rem; display: block; margin-bottom: 8px;"></i>
                                    <small class="fw-semibold">Riwayat Konseling</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('assessment.index') }}" class="text-decoration-none d-block">
                                <div style="padding: 15px; background: linear-gradient(135deg, #0099C9, #0077B6); border-radius: 10px; color: white; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fas fa-clipboard-list" style="font-size: 1.5rem; display: block; margin-bottom: 8px;"></i>
                                    <small class="fw-semibold">Penilaian Diri</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('kuisioner.index') }}" class="text-decoration-none d-block">
                                <div style="padding: 15px; background: linear-gradient(135deg, #00B4D8, #0096C7); border-radius: 10px; color: white; text-align: center; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fas fa-poll" style="font-size: 1.5rem; display: block; margin-bottom: 8px;"></i>
                                    <small class="fw-semibold">Kuisioner</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Konseling -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">Riwayat Konseling</h6>
                    <a href="{{ route('riwayat.index') }}" class="btn btn-sm" style="background-color: #0099C9; color: white; font-weight: 600;">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #f8f9ff;">
                                <tr>
                                    <th class="px-4 py-3" style="color: #0099C9; font-weight: 600;">Guru BK</th>
                                    <th class="px-4 py-3" style="color: #0099C9; font-weight: 600;">Tanggal</th>
                                    <th class="px-4 py-3" style="color: #0099C9; font-weight: 600;">Topik</th>
                                    <th class="px-4 py-3" style="color: #0099C9; font-weight: 600;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayatKonseling ?? [] as $riwayat)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <strong>{{ $riwayat->jadwal->guru->nama ?? '-' }}</strong>
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $riwayat->created_at->format('d M Y') ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ substr($riwayat->topik ?? '-', 0, 30) }}...
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('riwayat.show', $riwayat->riwayat_id) }}" class="btn btn-sm btn-outline-primary" style="border-color: #0099C9; color: #0099C9;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-center text-muted">
                                            Tidak ada riwayat konseling
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materi Terbaru -->
    <div class="row g-3">
        <div class="col-12">
            <h5 class="fw-bold mb-3">Materi BK Terbaru</h5>
        </div>
        @forelse($materiTerbaru ?? [] as $materi)
            <div class="col-md-4">
                <a href="{{ route('materi.show', $materi->materi_id) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-2">{{ $materi->judul ?? 'Materi' }}</h6>
                            <p class="text-muted small mb-3">{{ substr($materi->deskripsi ?? '', 0, 60) }}...</p>
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar me-1" style="color: #0099C9;"></i>
                                {{ $materi->tanggal_upload->format('d M Y') ?? '-' }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted py-4">
                        <p>Tidak ada materi tersedia</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 153, 201, 0.15) !important;
    }

    .btn-outline-primary {
        border-color: #0099C9;
        color: #0099C9;
    }

    .btn-outline-primary:hover {
        background-color: #0099C9;
        border-color: #0099C9;
        color: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0099C9, #0077B6) !important;
        border: none !important;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0077B6, #005a95) !important;
    }
</style>
@endsection
