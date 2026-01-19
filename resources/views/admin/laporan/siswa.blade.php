@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Laporan Data Siswa</h3>
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
                    <h5 class="card-title">Daftar Siswa</h5>
                </div>
                <div class="card-body">
                    @if($siswa->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nis ?? '-' }}</td>
                                    <td>{{ $item->nama_siswa ?? '-' }}</td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $item->kelas?->jurusan->nama_jurusan ?? '-' }}</td>
                                    <td>
                                        @if($item->status === 'aktif')
                                            <span class="badge badge-success">{{ $item->status }}</span>
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
                        <i class="fas fa-info-circle"></i> Belum ada data siswa
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
