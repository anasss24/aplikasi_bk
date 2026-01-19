@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Laporan Jadwal Konseling</h3>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Jadwal Konseling</h5>
                </div>
                <div class="card-body">
                    @if($jadwal->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Guru BK</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->guru->user->name ?? '-' }}</td>
                                    <td>{{ $item->jadwal_datetime?->format('d M Y H:i') ?? '-' }}</td>
                                    <td>{{ ucfirst($item->metode ?? '-') }}</td>
                                    <td>
                                        @if($item->status === 'approved')
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                        @elseif($item->status === 'pending')
                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada data jadwal konseling
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
