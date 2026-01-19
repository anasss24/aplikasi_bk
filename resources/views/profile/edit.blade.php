@extends('layouts.app')

@section('title', 'Edit Profile - Aplikasi BK')

@section('content')
<div>
    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="page-title mb-2">
            <i class="fas fa-user-circle me-2"></i>Edit Profile
        </h1>
        <p class="text-muted">Kelola informasi profil dan pengaturan akun Anda</p>
    </div>

    <!-- Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Update Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-2"></i>Informasi Profil
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Nama</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ auth()->user()->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ auth()->user()->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label"><strong>Role</strong></label>
                            <input type="text" class="form-control" id="role" value="{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}" disabled>
                            <small class="text-muted">Role tidak dapat diubah. Hubungi admin untuk perubahan role.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('profile.edit') }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-lock me-2"></i>Ubah Password
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="current_password" class="form-label"><strong>Password Saat Ini</strong></label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><strong>Password Baru</strong></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label"><strong>Konfirmasi Password</strong></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-lock me-2"></i>Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Account Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Informasi Akun
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>ID User:</strong>
                        <p class="text-muted mb-0">{{ auth()->user()->id }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Terdaftar:</strong>
                        <p class="text-muted mb-0">{{ auth()->user()->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div>
                        <strong>Terakhir Update:</strong>
                        <p class="text-muted mb-0">{{ auth()->user()->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Security Tips -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-shield me-2"></i>Keamanan
                </div>
                <div class="card-body">
                    <div class="alert alert-custom info" style="margin-bottom: 0; padding: 12px;">
                        <strong>💡 Tips Keamanan:</strong>
                        <ul style="margin-top: 10px; margin-bottom: 0; padding-left: 20px;">
                            <li>Gunakan password yang kuat minimal 8 karakter</li>
                            <li>Jangan bagikan password dengan siapapun</li>
                            <li>Ubah password secara berkala</li>
                            <li>Logout dari perangkat yang tidak dikenal</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
