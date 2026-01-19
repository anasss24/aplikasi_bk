@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold text-dark mb-0">Dashboard</h1>
            <p class="text-muted mb-0">Selamat datang!</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('chat.index') }}" class="text-decoration-none">
                                <div class="text-center p-3 border rounded-3">
                                    <i class="fas fa-comments fa-2x text-primary mb-3 d-block"></i>
                                    <h6 class="fw-bold">Chat</h6>
                                    <small class="text-muted">Komunikasi dengan pengguna</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('assessment.index') }}" class="text-decoration-none">
                                <div class="text-center p-3 border rounded-3">
                                    <i class="fas fa-clipboard-list fa-2x text-success mb-3 d-block"></i>
                                    <h6 class="fw-bold">Assessment</h6>
                                    <small class="text-muted">Penilaian diri</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('kuisioner.index') }}" class="text-decoration-none">
                                <div class="text-center p-3 border rounded-3">
                                    <i class="fas fa-poll fa-2x text-warning mb-3 d-block"></i>
                                    <h6 class="fw-bold">Kuisioner</h6>
                                    <small class="text-muted">Survei dan evaluasi</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('log.index') }}" class="text-decoration-none">
                                <div class="text-center p-3 border rounded-3">
                                    <i class="fas fa-list fa-2x text-danger mb-3 d-block"></i>
                                    <h6 class="fw-bold">Log Aktivitas</h6>
                                    <small class="text-muted">Catatan aktivitas</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <a href="/admin/users" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">Total Admin</p>
                                <h3 class="fw-bold text-primary mb-0">1</h3>
                            </div>
                            <i class="fas fa-user-shield text-primary opacity-50" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="/admin/laporan/siswa" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">Total Siswa</p>
                                <h3 class="fw-bold text-info mb-0">{{ $totalSiswa ?? 0 }}</h3>
                            </div>
                            <i class="fas fa-graduation-cap text-info opacity-50" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="/admin/users" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">Total Guru BK</p>
                                <h3 class="fw-bold text-success mb-0">{{ $totalGuruBK ?? 0 }}</h3>
                            </div>
                            <i class="fas fa-chalkboard-user text-success opacity-50" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="/riwayat" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-1">Total Sesi Konseling</p>
                                <h3 class="fw-bold text-warning mb-0">{{ $totalSesiKonseling ?? 0 }}</h3>
                            </div>
                            <i class="fas fa-comments text-warning opacity-50" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
    }
    
    .border:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection
