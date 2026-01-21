@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-4">Buat Jadwal Konseling Baru</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Pilih Siswa</label>
                            <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($siswaList as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->nama_siswa }} ({{ $siswa->nis }})
                                    </option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="guru_id" class="form-label">Pilih Guru BK</label>
                            <select name="guru_id" id="guru_id" class="form-control @error('guru_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Guru BK --</option>
                                @foreach($guruList as $guru)
                                    <option value="{{ $guru->guru_id }}" {{ old('guru_id') == $guru->guru_id ? 'selected' : '' }}>
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_datetime" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" name="jadwal_datetime" id="jadwal_datetime" 
                                   class="form-control @error('jadwal_datetime') is-invalid @enderror" 
                                   value="{{ old('jadwal_datetime') }}" required>
                            @error('jadwal_datetime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode" class="form-label">Metode Konseling</label>
                            <select name="metode" id="metode" class="form-control @error('metode') is-invalid @enderror" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="online" {{ old('metode') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('metode') == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                            @error('metode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Tempat Konseling</label>
                            <select name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror">
                                <option value="">-- Pilih Tempat Konseling --</option>
                                <option value="ruang_bk" {{ old('lokasi') == 'ruang_bk' ? 'selected' : '' }}>Ruang BK</option>
                                <option value="chat" {{ old('lokasi') == 'chat' ? 'selected' : '' }}>Chat</option>
                            </select>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="masalah" class="form-label">Masalah yang Sedang Dialami</label>
                            <select name="masalah" id="masalah" class="form-control @error('masalah') is-invalid @enderror">
                                <option value="">-- Pilih Masalah --</option>
                                <option value="masalah_akademik" {{ old('masalah') == 'masalah_akademik' ? 'selected' : '' }}>Masalah Akademik (Nilai, Kesulitan Belajar)</option>
                                <option value="masalah_keluarga" {{ old('masalah') == 'masalah_keluarga' ? 'selected' : '' }}>Masalah Keluarga</option>
                                <option value="masalah_sosial" {{ old('masalah') == 'masalah_sosial' ? 'selected' : '' }}>Masalah Sosial (Pertemanan, Bullying)</option>
                                <option value="masalah_emosional" {{ old('masalah') == 'masalah_emosional' ? 'selected' : '' }}>Masalah Emosional (Stres, Kecemasan, Depresi)</option>
                                <option value="masalah_karir" {{ old('masalah') == 'masalah_karir' ? 'selected' : '' }}>Masalah Karir & Masa Depan</option>
                                <option value="masalah_pribadi" {{ old('masalah') == 'masalah_pribadi' ? 'selected' : '' }}>Masalah Pribadi (Kepercayaan Diri, Identitas)</option>
                                <option value="masalah_kesehatan" {{ old('masalah') == 'masalah_kesehatan' ? 'selected' : '' }}>Masalah Kesehatan & Kebiasaan</option>
                                <option value="masalah_disiplin" {{ old('masalah') == 'masalah_disiplin' ? 'selected' : '' }}>Masalah Disiplin & Tata Tertib</option>
                                <option value="lainnya" {{ old('masalah') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('masalah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Buat Jadwal
                            </button>
                            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
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
