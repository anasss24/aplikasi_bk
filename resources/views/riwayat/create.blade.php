@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Buat Riwayat Konseling</h2>
        <p class="text-muted">Catat hasil sesi konseling</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('riwayat.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label class="form-label">Jadwal Konseling <span class="text-danger">*</span></label>
                <select name="jadwal_id" class="form-select @error('jadwal_id') is-invalid @enderror" required>
                  <option value="">Pilih Jadwal Konseling...</option>
                  @foreach($jadwals as $j)
                    <option value="{{ $j->jadwal_id }}" {{ old('jadwal_id') == $j->jadwal_id ? 'selected' : '' }}>
                      {{ $j->siswa->nama_siswa ?? 'N/A' }} - {{ $j->jadwal_datetime->format('d M Y H:i') }}
                    </option>
                  @endforeach
                </select>
                @error('jadwal_id')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Topik Konseling <span class="text-danger">*</span></label>
                <input type="text" name="topik" class="form-control @error('topik') is-invalid @enderror"
                  value="{{ old('topik') }}" placeholder="Misal: Masalah akademik, Bullying, dll" required>
                @error('topik')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Isi Konseling <span class="text-danger">*</span></label>
                <textarea name="isi_konseling" class="form-control @error('isi_konseling') is-invalid @enderror" rows="5"
                  required placeholder="Deskripsikan hasil konseling secara detail">{{ old('isi_konseling') }}</textarea>
                @error('isi_konseling')
                  <span class="invalid-feedback">{{ $message }}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Tindak Lanjut</label>
                <textarea name="tindak_lanjut" class="form-control" rows="3"
                  placeholder="Rencana tindak lanjut untuk siswa">{{ old('tindak_lanjut') }}</textarea>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Status Tindak Lanjut</label>
                  <select name="status_tindak_lanjut" class="form-select">
                    <option value="">Pilih Status...</option>
                    <option value="belum_dilaksanakan" {{ old('status_tindak_lanjut') == 'belum_dilaksanakan' ? 'selected' : '' }}>Belum Dilaksanakan</option>
                    <option value="sedang_berjalan" {{ old('status_tindak_lanjut') == 'sedang_berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                    <option value="selesai" {{ old('status_tindak_lanjut') == 'selesai' ? 'selected' : '' }}>Selesai
                    </option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Tanggal Konseling</label>
                  <input type="date" name="tanggal_riwayat" class="form-control" value="{{ old('tanggal_riwayat') }}">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Lampiran (Opsional)</label>
                <input type="file" name="lampiran_url" class="form-control @error('lampiran_url') is-invalid @enderror"
                  accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <small class="text-muted">Format: PDF, DOC, DOCX, JPG, PNG (Max 5MB)</small>
                @error('lampiran_url')
                  <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group d-flex gap-2">
                <a href="{{ route('riwayat.index') }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-times me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 140px; height: 40px; display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-save me-2"></i>Simpan Riwayat
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection