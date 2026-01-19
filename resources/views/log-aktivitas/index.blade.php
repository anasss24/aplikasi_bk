@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold text-dark mb-0">Log Aktivitas</h1>
            <p class="text-muted mb-0">Pencatatan semua aktivitas pengguna di aplikasi</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Aksi</th>
                                <th>Deskripsi</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ $log->user->name }}" alt="{{ $log->user->name }}" class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <p class="mb-0 fw-bold">{{ $log->user->name }}</p>
                                                <small class="text-muted">{{ $log->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $log->aksi }}</span>
                                    </td>
                                    <td>{{ $log->deskripsi ?? '-' }}</td>
                                    <td>
                                        <small class="text-muted">{{ $log->waktu->format('d M Y H:i') }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 opacity-25 d-block"></i>
                                        Tidak ada log aktivitas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
