@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Catat Sesi Konseling</h2>
            <p class="text-muted">Dokumentasikan hasil dan progres konseling dengan siswa</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan!</strong>
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
            <form action="{{ route('riwayat.update', $riwayat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Siswa & Waktu -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-user"></i> Informasi Siswa & Waktu</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Siswa <span class="text-danger">*</span></label>
                                <div class="form-control-plaintext fw-bold">
                                    {{ $riwayat->jadwal->siswa->nama_siswa ?? 'N/A' }} ({{ $riwayat->jadwal->siswa->nisn ?? 'N/A' }})
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Konseling <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_riwayat" class="form-control @error('tanggal_riwayat') is-invalid @enderror" 
                                    value="{{ old('tanggal_riwayat', $riwayat->tanggal_riwayat) }}" required>
                                @error('tanggal_riwayat')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" name="waktu_mulai" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                                    value="{{ old('waktu_mulai', $riwayat->waktu_mulai) }}" required>
                                @error('waktu_mulai')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Durasi Konseling (menit) <span class="text-danger">*</span></label>
                                <input type="number" name="durasi" class="form-control @error('durasi') is-invalid @enderror" 
                                    value="{{ old('durasi', $riwayat->durasi) }}" min="5" max="180" required>
                                <small class="text-muted d-block mt-1">Contoh: 30, 45, 60</small>
                                @error('durasi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Topik & Metode Konseling -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-comments"></i> Topik & Metode Konseling</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Topik Konseling <span class="text-danger">*</span></label>
                            <select name="topik" class="form-select @error('topik') is-invalid @enderror" required>
                                <option value="">Pilih Topik Konseling...</option>
                                <option value="Akademik" {{ old('topik', $riwayat->topik) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="Pribadi" {{ old('topik', $riwayat->topik) == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                                <option value="Sosial" {{ old('topik', $riwayat->topik) == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                <option value="Perilaku" {{ old('topik', $riwayat->topik) == 'Perilaku' ? 'selected' : '' }}>Perilaku</option>
                                <option value="Karir" {{ old('topik', $riwayat->topik) == 'Karir' ? 'selected' : '' }}>Karir</option>
                                <option value="Bullying/Kekerasan" {{ old('topik', $riwayat->topik) == 'Bullying/Kekerasan' ? 'selected' : '' }}>Bullying/Kekerasan</option>
                                <option value="Keluarga" {{ old('topik', $riwayat->topik) == 'Keluarga' ? 'selected' : '' }}>Keluarga</option>
                                <option value="Lainnya" {{ old('topik', $riwayat->topik) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('topik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Metode Konseling <span class="text-danger">*</span></label>
                                <select name="metode" class="form-select @error('metode') is-invalid @enderror" required>
                                    <option value="">Pilih Metode...</option>
                                    <option value="tatap_muka" {{ old('metode', $riwayat->metode) == 'tatap_muka' ? 'selected' : '' }}>Tatap Muka</option>
                                    <option value="online" {{ old('metode', $riwayat->metode) == 'online' ? 'selected' : '' }}>Online</option>
                                </select>
                                @error('metode')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi</label>
                                <select name="lokasi" class="form-select">
                                    <option value="">Pilih Lokasi...</option>
                                    <option value="ruang_bk" {{ old('lokasi', $riwayat->lokasi) == 'ruang_bk' ? 'selected' : '' }}>Ruang BK</option>
                                    <option value="chat" {{ old('lokasi', $riwayat->lokasi) == 'chat' ? 'selected' : '' }}>Chat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Isi Konseling -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-pen-fancy"></i> Isi Konseling</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Uraian Konseling <span class="text-danger">*</span></label>
                            <textarea name="isi_konseling" class="form-control @error('isi_konseling') is-invalid @enderror" 
                                rows="6" placeholder="Tuliskan detail konseling yang dilakukan..." required>{{ old('isi_konseling', $riwayat->isi_konseling) }}</textarea>
                            @error('isi_konseling')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Progres dan Tindak Lanjut -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-chart-line"></i> Progres dan Tindak Lanjut</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Progres Siswa</label>
                            <textarea name="progres" class="form-control @error('progres') is-invalid @enderror" 
                                rows="3" placeholder="Deskripsikan progres atau perkembangan siswa...">{{ old('progres', $riwayat->progres) }}</textarea>
                            @error('progres')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rencana Tindak Lanjut</label>
                            <textarea name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror" 
                                rows="3" placeholder="Tuliskan rencana tindak lanjut konseling...">{{ old('tindak_lanjut', $riwayat->tindak_lanjut) }}</textarea>
                            @error('tindak_lanjut')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Tindak Lanjut</label>
                            <select name="status_tindak_lanjut" class="form-select @error('status_tindak_lanjut') is-invalid @enderror">
                                <option value="">Pilih Status...</option>
                                <option value="selesai" {{ old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="perlu_follow_up" {{ old('status_tindak_lanjut', $riwayat->status_tindak_lanjut) == 'perlu_follow_up' ? 'selected' : '' }}>Perlu Follow Up</option>
                            </select>
                            @error('status_tindak_lanjut')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-paperclip"></i> Lampiran (Opsional)</label>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Upload File Lampiran</label>
                            <input type="file" name="lampiran_url" class="form-control @error('lampiran_url') is-invalid @enderror"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="text-muted d-block mt-1">Format: PDF, DOC, DOCX, JPG, PNG (Max: 5MB)</small>
                            @error('lampiran_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Catatan Konseling
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Info Jadwal</h6>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <small class="text-muted d-block">Guru BK</small>
                        <strong>{{ $riwayat->jadwal->guru->nama ?? 'N/A' }}</strong>
                    </div>
                    <div class="list-group-item">
                        <small class="text-muted d-block">Jadwal Awal</small>
                        <strong>{{ $riwayat->jadwal->jadwal_datetime->format('d M Y H:i') }}</strong>
                    </div>
                    <div class="list-group-item">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-success">Disetujui</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Panduan Pengisian</h6>
                </div>
                <div class="card-body">
                    <ul class="small text-muted ps-3">
                        <li>Isi semua field yang bertanda <span class="text-danger">*</span></li>
                        <li>Jelaskan secara detail isi konseling</li>
                        <li>Sertakan progres dan tindak lanjut</li>
                        <li>Upload lampiran jika ada dokumentasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control-plaintext {
        padding-top: 0.375rem;
        padding-bottom: 0.375rem;
    }
</style>
@endpush
@endsection
