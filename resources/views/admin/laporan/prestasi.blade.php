@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Rekap Pelanggaran Siswa</h3>
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
                    <h5 class="card-title">Daftar Pelanggaran Siswa</h5>
                </div>
                <div class="card-body">
                    @if($pelanggaran->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Tingkat</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelanggaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->jenis_pelanggaran ?? '-' }}</td>
                                    <td>
                                        @if($item->tingkat === 'ringan')
                                            <span class="badge badge-warning">Ringan</span>
                                        @elseif($item->tingkat === 'sedang')
                                            <span class="badge badge-info">Sedang</span>
                                        @else
                                            <span class="badge badge-danger">Berat</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->deskripsi ?? '-' }}</td>
                                    <td>{{ $item->tanggal?->format('d M Y') ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada data pelanggaran siswa
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
