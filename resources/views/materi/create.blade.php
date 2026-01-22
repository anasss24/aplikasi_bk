@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Unggah Materi BK</h2>
        <p class="text-muted">Bagikan materi bimbingan dengan siswa</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label class="form-label">Judul Materi <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                  value="{{ old('judul') }}" required placeholder="Contoh: Tips Mengatasi Stress">
                @error('judul')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required
                  placeholder="Jelaskan ringkas isi dari materi ini">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Kategori <span class="text-danger">*</span></label>
                  <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                    <option value="">Pilih Kategori...</option>
                    <option value="kelas10" {{ old('kategori') == 'kelas10' ? 'selected' : '' }}>Kelas 10</option>
                    <option value="kelas11" {{ old('kategori') == 'kelas11' ? 'selected' : '' }}>Kelas 11</option>
                    <option value="kelas12" {{ old('kategori') == 'kelas12' ? 'selected' : '' }}>Kelas 12</option>
                  </select>
                  @error('kategori')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Upload</label>
                  <input type="date" name="tanggal_upload" class="form-control"
                    value="{{ old('tanggal_upload', now()->toDateString()) }}">
                </div>
              </div>



              <div class="form-group d-flex gap-2">
                <a href="{{ route('materi.index') }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-times me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 140px; height: 40px; display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-upload me-2"></i>Unggah Materi
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection