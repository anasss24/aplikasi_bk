@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0"><i class="fas fa-file-medical me-2"></i>Catat Sesi Konseling</h2>
        <p class="text-muted">Dokumentasikan hasil dan progres konseling dengan siswa</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-body p-4">
            <form action="{{ route('riwayat.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              {{-- Informasi Dasar --}}
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-user me-2"></i>Informasi Siswa & Waktu</h5>
                
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Siswa <span class="text-danger">*</span></label>
                    <select name="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror" required>
                      <option value="">-- Pilih Siswa --</option>
                      @foreach($siswa as $s)
                        <option value="{{ $s->id }}" {{ old('siswa_id', $selectedJadwal->siswa_id ?? '') == $s->id ? 'selected' : '' }}>
                          {{ $s->nama_siswa }} ({{ $s->nis }})
                        </option>
                      @endforeach
                    </select>
                    @error('siswa_id')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Konseling <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_riwayat" class="form-control @error('tanggal_riwayat') is-invalid @enderror" 
                      value="{{ old('tanggal_riwayat', $selectedJadwal?->jadwal_datetime?->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                    @error('tanggal_riwayat')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                    <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                      value="{{ old('waktu_mulai') }}" required>
                    @error('waktu_mulai')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Durasi Konseling (menit) <span class="text-danger">*</span></label>
                    <input type="number" name="durasi" class="form-control @error('durasi') is-invalid @enderror" 
                      value="{{ old('durasi') }}" min="5" max="180" required>
                    <small class="text-muted">Contoh: 30, 45, 60</small>
                    @error('durasi')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>

              <hr>

              {{-- Topik & Metode --}}
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-comment-dots me-2"></i>Topik & Metode Konseling</h5>

                <div class="mb-3">
                  <label class="form-label">Topik/Masalah yang Dibahas <span class="text-danger">*</span></label>
                  <select name="topik" class="form-select @error('topik') is-invalid @enderror" required>
                    <option value="">-- Pilih Topik --</option>
                    <option value="Akademik" {{ old('topik') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Pribadi" {{ old('topik') == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                    <option value="Sosial" {{ old('topik') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="Perilaku" {{ old('topik') == 'Perilaku' ? 'selected' : '' }}>Perilaku</option>
                    <option value="Karir" {{ old('topik') == 'Karir' ? 'selected' : '' }}>Karir</option>
                    <option value="Bullying/Kekerasan" {{ old('topik') == 'Bullying/Kekerasan' ? 'selected' : '' }}>Bullying/Kekerasan</option>
                    <option value="Keluarga" {{ old('topik') == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                    <option value="Lainnya" {{ old('topik') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                  </select>
                  @error('topik')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Metode Konseling <span class="text-danger">*</span></label>
                    <select name="metode" class="form-select @error('metode') is-invalid @enderror" required>
                      <option value="">-- Pilih Metode --</option>
                      <option value="tatap_muka" {{ old('metode') == 'tatap_muka' ? 'selected' : '' }}>Tatap Muka</option>
                      <option value="online" {{ old('metode') == 'online' ? 'selected' : '' }}>Online</option>
                    </select>
                    @error('metode')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi Konseling</label>
                    <select name="lokasi" class="form-select">
                      <option value="">-- Pilih Lokasi --</option>
                      <option value="ruang_bk" {{ old('lokasi') == 'ruang_bk' ? 'selected' : '' }}>Ruang BK</option>
                      <option value="chat" {{ old('lokasi') == 'chat' ? 'selected' : '' }}>Chat</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr>

              {{-- Hasil & Pembahasan --}}
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-clipboard-list me-2"></i>Hasil & Pembahasan</h5>

                <div class="mb-3">
                  <label class="form-label">Hasil Konseling/Pembahasan <span class="text-danger">*</span></label>
                  <textarea name="isi_konseling" class="form-control @error('isi_konseling') is-invalid @enderror" 
                    rows="5" required placeholder="Jelaskan hasil konseling, apa yang dibahas, dan kondisi emosional siswa...">{{ old('isi_konseling') }}</textarea>
                  @error('isi_konseling')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label class="form-label">Perkembangan/Progres Siswa</label>
                  <textarea name="progres" class="form-control" rows="3" 
                    placeholder="Catatan tentang perkembangan atau perubahan perilaku siswa...">{{ old('progres') }}</textarea>
                </div>
              </div>

              <hr>

              {{-- Rencana Tindak Lanjut --}}
              <div class="mb-4">
                <h5 class="card-title mb-3"><i class="fas fa-tasks me-2"></i>Rencana Tindak Lanjut</h5>

                <div class="mb-3">
                  <label class="form-label">Rekomendasi/Rencana Tindak Lanjut</label>
                  <textarea name="tindak_lanjut" class="form-control" rows="3" 
                    placeholder="Apa yang perlu dilakukan selanjutnya? Apakah ada konseling lanjutan, rujukan, atau tindakan lainnya?">{{ old('tindak_lanjut') }}</textarea>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Status Tindak Lanjut</label>
                    <select name="status_tindak_lanjut" class="form-select">
                      <option value="">-- Pilih Status --</option>
                      <option value="selesai" {{ old('status_tindak_lanjut') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                      <option value="perlu_follow_up" {{ old('status_tindak_lanjut') == 'perlu_follow_up' ? 'selected' : '' }}>Perlu Follow-up</option>
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Jadwalkan Follow-up (Opsional)</label>
                    <input type="date" name="tanggal_follow_up" class="form-control" value="{{ old('tanggal_follow_up') }}">
                  </div>
                </div>
              </div>

              {{-- Buttons --}}
              <div class="form-group d-flex gap-2 mt-4">
                <a href="{{ route('riwayat.index') }}" class="btn btn-secondary" style="padding: 10px 28px; font-weight: 600;">
                  <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary" style="padding: 10px 28px; font-weight: 600;">
                  <i class="fas fa-save me-2"></i>Simpan Riwayat Konseling
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection