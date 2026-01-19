@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Tambah Kelas</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Kelas</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/kelas" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kode_kelas" class="form-label">Kode Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror" 
                                   id="kode_kelas" name="kode_kelas" value="{{ old('kode_kelas') }}" required>
                            @error('kode_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" 
                                   id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan <span class="text-danger">*</span></label>
                            <select class="form-select @error('jurusan_id') is-invalid @enderror" 
                                    id="jurusan_id" name="jurusan_id" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat <span class="text-danger">*</span></label>
                            <select class="form-select @error('tingkat') is-invalid @enderror" 
                                    id="tingkat" name="tingkat" required>
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="10" {{ old('tingkat') == 10 ? 'selected' : '' }}>X (Kelas 1)</option>
                                <option value="11" {{ old('tingkat') == 11 ? 'selected' : '' }}>XI (Kelas 2)</option>
                                <option value="12" {{ old('tingkat') == 12 ? 'selected' : '' }}>XII (Kelas 3)</option>
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
