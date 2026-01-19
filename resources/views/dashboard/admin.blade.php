@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header with Real-time Clock -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold text-dark mb-0">Admin Dashboard</h1>
                    <p class="text-muted mb-0">Kelola seluruh sistem aplikasi BK</p>
                </div>
                <div style="background: linear-gradient(135deg, #0099C9, #0077B6); padding: 15px 25px; border-radius: 10px; color: white; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 153, 201, 0.2);">
                    <i class="fas fa-calendar me-2"></i><span id="real-time-clock">--:--:--</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-2 fw-semibold">Total Siswa</p>
                            <h3 class="fw-bold mb-0" style="color: #0099C9;">{{ $totalSiswa ?? 0 }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: rgba(0, 153, 201, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-graduation-cap" style="color: #0099C9; font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-2 fw-semibold">Total Guru BK</p>
                            <h3 class="fw-bold mb-0" style="color: #0077B6;">{{ $totalGuruBK ?? 0 }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: rgba(0, 119, 182, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chalkboard-user" style="color: #0077B6; font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-2 fw-semibold">Total Kelas</p>
                            <h3 class="fw-bold mb-0" style="color: #0099C9;">{{ $totalKelas ?? 0 }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: rgba(0, 153, 201, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-door-open" style="color: #0099C9; font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted small mb-2 fw-semibold">Jadwal Konseling</p>
                            <h3 class="fw-bold mb-0" style="color: #0077B6;">{{ $totalJadwal ?? 0 }}</h3>
                        </div>
                        <div style="width: 50px; height: 50px; background: rgba(0, 119, 182, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-calendar-check" style="color: #0077B6; font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="fw-bold mb-3">Manajemen Data</h5>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.siswa.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #0099C9, #0077B6); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-users" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Manajemen Siswa</h6>
                                <p class="text-muted small mb-0">Kelola data siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.kelas.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #0099C9, #0077B6); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-door-open" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Manajemen Kelas</h6>
                                <p class="text-muted small mb-0">Kelola data kelas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.jurusan.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #0099C9, #0077B6); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-sitemap" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Manajemen Jurusan</h6>
                                <p class="text-muted small mb-0">Kelola data jurusan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Reports Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="fw-bold mb-3">Laporan</h5>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.laporan.siswa') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #00B4D8, #0096C7); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-chart-bar" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Laporan Siswa</h6>
                                <p class="text-muted small mb-0">Lihat statistik siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.laporan.jadwal') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #00B4D8, #0096C7); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-calendar-alt" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Laporan Jadwal</h6>
                                <p class="text-muted small mb-0">Lihat jadwal konseling</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.laporan.prestasi') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #00B4D8, #0096C7); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <i class="fas fa-trophy" style="color: white; font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Laporan Prestasi</h6>
                                <p class="text-muted small mb-0">Lihat data prestasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row g-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom px-4 py-3">
                    <h6 class="fw-bold mb-0">Aktivitas Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 fw-semibold">{{ $activity->aksi ?? 'Aktivitas' }}</p>
                                <small class="text-muted">{{ $activity->deskripsi ?? 'Tidak ada deskripsi' }}</small>
                            </div>
                            <small class="text-muted">{{ isset($activity->waktu) ? \Carbon\Carbon::parse($activity->waktu)->diffForHumans() : '-' }}</small>
                        </div>
                    @empty
                        <div class="px-4 py-4 text-center text-muted">
                            <p>Tidak ada aktivitas terbaru</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 153, 201, 0.15) !important;
    }
</style>
@endsection
