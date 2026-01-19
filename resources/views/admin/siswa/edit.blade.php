@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold text-dark mb-0">Edit Siswa</h1>
            <p class="text-muted mb-0">Ubah data siswa</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="/admin/siswa/{{ $siswa->id }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn', $siswa->nisn) }}" required inputmode="numeric" pattern="[0-9]+" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                @error('nisn')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa <span class="text-danger">*</span></label>
                            <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ old('nama_siswa', $siswa->nama_siswa) }}" required>
                            @error('nama_siswa')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="laki-laki" @if(old('jenis_kelamin', $siswa->jenis_kelamin) === 'laki-laki') selected @endif>Laki-laki</option>
                                    <option value="perempuan" @if(old('jenis_kelamin', $siswa->jenis_kelamin) === 'perempuan') selected @endif>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->kelas_id }}" @if(old('kelas_id', $siswa->kelas_id) == $k->kelas_id) selected @endif>
                                            {{ $k->nama_kelas }} ({{ $k->jurusan?->nama_jurusan ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $siswa->alamat) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">No. Telepon</label>
                                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $siswa->no_telepon) }}" inputmode="numeric" pattern="[0-9]+" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $siswa->email) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif" @if(old('status', $siswa->status) === 'aktif') selected @endif>Aktif</option>
                                <option value="tidak-aktif" @if(old('status', $siswa->status) === 'tidak-aktif') selected @endif>Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="gap: 8px !important;">
                            <a href="/admin/siswa" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
