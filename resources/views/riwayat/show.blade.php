@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Detail Riwayat Konseling</h2>
        <p class="text-muted">Informasi lengkap hasil konseling</p>
      </div>
      <div class="col-md-4 text-end">
        @if((Auth::user()->role ?? null) === 'guru_bk' || (Auth::user()->role ?? null) === 'admin')
          <a href="{{ route('riwayat.edit', $riwayat) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
          </a>
        @endif
        <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <!-- Informasi Dasar -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Informasi Konseling</h6>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="text-muted small">Siswa</label>
                <p class="mb-0"><strong>{{ $riwayat->jadwal->siswa->nama_siswa ?? 'N/A' }}</strong></p>
              </div>
              <div class="col-md-6">
                <label class="text-muted small">Guru BK</label>
                <p class="mb-0"><strong>{{ $riwayat->jadwal->guru->nama ?? 'N/A' }}</strong></p>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label class="text-muted small">Tanggal Konseling</label>
                <p class="mb-0">{{ $riwayat->tanggal_riwayat->format('d F Y') }}</p>
              </div>
              <div class="col-md-6">
                <label class="text-muted small">Topik Konseling</label>
                <p class="mb-0"><strong>{{ $riwayat->topik }}</strong></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Isi Konseling -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Isi Konseling</h6>
          </div>
          <div class="card-body">
            <p class="mb-0" style="white-space: pre-wrap;">{{ $riwayat->isi_konseling }}</p>
          </div>
        </div>

        <!-- Tindak Lanjut -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Tindak Lanjut</h6>
          </div>
          <div class="card-body">
            @if($riwayat->tindak_lanjut)
              <div class="mb-3">
                <label class="text-muted small">Rencana Tindak Lanjut</label>
                <p class="mb-0" style="white-space: pre-wrap;">{{ $riwayat->tindak_lanjut }}</p>
              </div>
              <div>
                <label class="text-muted small">Status Tindak Lanjut</label>
                <p class="mb-0">
                  <span
                    class="badge bg-{{ $riwayat->status_tindak_lanjut === 'selesai' ? 'success' : ($riwayat->status_tindak_lanjut === 'sedang_berjalan' ? 'warning' : 'secondary') }}">
                    {{ ucfirst(str_replace('_', ' ', $riwayat->status_tindak_lanjut ?? 'belum_dilaksanakan')) }}
                  </span>
                </p>
              </div>
            @else
              <p class="text-muted mb-0">Tidak ada tindak lanjut yang dicatat</p>
            @endif
          </div>
        </div>

        <!-- Lampiran -->
        @if($riwayat->lampiran_url)
          <div class="card mb-3">
            <div class="card-header bg-primary text-white">
              <h6 class="mb-0">Lampiran</h6>
            </div>
            <div class="card-body">
              <a href="{{ asset('storage/' . $riwayat->lampiran_url) }}" class="btn btn-sm btn-outline-primary"
                target="_blank">
                <i class="fas fa-download"></i> Download Lampiran
              </a>
            </div>
          </div>
        @endif

        <!-- Informasi Sistem -->
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Informasi Sistem</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted">Dibuat</small>
              <p class="mb-0">{{ $riwayat->created_at->format('d F Y H:i') }}</p>
            </div>
            <div class="list-group-item">
              <small class="text-muted">Diperbarui</small>
              <p class="mb-0">{{ $riwayat->updated_at->format('d F Y H:i') }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Ringkasan</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted d-block">ID Riwayat</small>
              <strong>{{ $riwayat->riwayat_id }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Jadwal ID</small>
              <strong>{{ $riwayat->jadwal_id }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Dibuat Oleh</small>
              <strong>{{ $riwayat->guru->nama ?? 'Admin' }}</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .list-group-item {
      padding: 1rem;
    }

    .list-group-item small {
      display: block;
      margin-bottom: 0.25rem;
    }
  </style>
@endsection