@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Pengaturan Admin</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Profil Admin</h5>
                </div>
                <div class="card-body">
                    @php
                        $user = auth()->user();
                    @endphp
                    <div class="form-group mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ $user?->name ?? 'N/A' }}" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user?->email ?? 'N/A' }}" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user?->role ?? 'N/A') }}" disabled>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Terdaftar Sejak</label>
                        <input type="text" class="form-control" value="{{ $user?->created_at?->format('d M Y H:i') ?? 'N/A' }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted">Total User</p>
                        <h4 class="text-primary">2</h4>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted">Admin</p>
                        <h4 class="text-success">1</h4>
                    </div>
                    <div>
                        <p class="text-muted">Belum Terverifikasi</p>
                        <h4 class="text-warning">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
