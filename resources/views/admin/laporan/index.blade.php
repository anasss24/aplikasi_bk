@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Laporan</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pilih Jenis Laporan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center p-4" style="cursor: pointer; border: 2px solid #e3e6f0; transition: 0.3s;">
                                <div class="mb-3">
                                    <i class="fas fa-users fa-3x text-primary"></i>
                                </div>
                                <h5>Laporan Data Siswa</h5>
                                <p class="text-muted">Rekap data semua siswa</p>
                                <a href="{{ route('admin.laporan.siswa') }}" class="btn btn-sm btn-primary">Lihat Laporan</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center p-4" style="cursor: pointer; border: 2px solid #e3e6f0; transition: 0.3s;">
                                <div class="mb-3">
                                    <i class="fas fa-calendar fa-3x text-success"></i>
                                </div>
                                <h5>Laporan Jadwal Konseling</h5>
                                <p class="text-muted">Rekap jadwal konseling siswa</p>
                                <a href="{{ route('admin.laporan.jadwal') }}" class="btn btn-sm btn-success">Lihat Laporan</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center p-4" style="cursor: pointer; border: 2px solid #e3e6f0; transition: 0.3s;">
                                <div class="mb-3">
                                    <i class="fas fa-chart-bar fa-3x text-warning"></i>
                                </div>
                                <h5>Rekap Pelanggaran Siswa</h5>
                                <p class="text-muted">Daftar pelanggaran siswa</p>
                                <a href="{{ route('admin.laporan.prestasi') }}" class="btn btn-sm btn-warning">Lihat Laporan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Laporan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada laporan yang dihasilkan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
