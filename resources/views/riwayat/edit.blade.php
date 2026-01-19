@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0">Edit Riwayat Konseling</h2>
            <p class="text-muted">Perbarui catatan konseling</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('riwayat.update', $riwayat) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Jadwal Konseling <span class="text-danger">*</span></label>
                            <select name="jadwal_id" class="form-select @error('jadwal_id') is-invalid @enderror" required>
                                <option value="">Pilih Jadwal Konseling...</option>
                                @foreach($jadwals as $j)
                                    <option value="{{ $j->jadwal_id }}" {{ old('jadwal_id', $riwayat->jadwal_id) == $j->jadwal_id ? 'selected' : '' }}>
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
                                value="{{ old('topik', $riwayat->topik) }}" required>
                            @error('topik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Konseling <span class="text-danger">*</span></label>
                            <textarea name="isi_konseling" class="form-control @error('isi_konseling') is-invalid @enderror" 
                                rows="5" required>{{ old('isi_konseling', $riwayat->isi_konseling) }}</textarea>
                            @error('isi_konseling')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tindak Lanjut</label>
                            <textarea name="tindak_lanjut" class="form-control" rows="3">{{ old('tindak_lanjut', $riwayat->tindak_lanjut) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Tindak Lanjut</label>
                                <select name="status_tindak_lanjut" class="form-select">
                                    <option value="">Pilih Status...</option>
                                    <option value="belum_dilaksanakan" {{ old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'belum_dilaksanakan' ? 'selected' : '' }}>Belum Dilaksanakan</option>
                                    <option value="sedang_berjalan" {{ old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'sedang_berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                                    <option value="selesai" {{ old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Konseling</label>
                                <input type="date" name="tanggal_riwayat" class="form-control" value="{{ old('tanggal_riwayat', $riwayat->tanggal_riwayat) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lampiran (Opsional)</label>
                            @if($riwayat->lampiran_url)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $riwayat->lampiran_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Lihat Lampiran Saat Ini
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="lampiran_url" class="form-control @error('lampiran_url') is-invalid @enderror" 
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, DOC, DOCX, JPG, PNG (Max 5MB)</small>
                            @error('lampiran_url')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group d-flex gap-2">
                            <a href="{{ route('riwayat.show', $riwayat) }}" class="btn btn-danger" style="padding: 8px 24px; font-weight: 500; min-width: 100px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" style="padding: 8px 24px; font-weight: 500; min-width: 160px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
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
