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
              <p class="mb-0">
                <span class="time-relative" data-timestamp="{{ $riwayat->created_at->timestamp }}">
                  {{ $riwayat->created_at->format('d F Y H:i') }}
                </span>
              </p>
            </div>
            <div class="list-group-item">
              <small class="text-muted">Diperbarui</small>
              <p class="mb-0">
                <span class="time-relative" data-timestamp="{{ $riwayat->updated_at->timestamp }}">
                  {{ $riwayat->updated_at->format('d F Y H:i') }}
                </span>
              </p>
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

  <script>
    // Function to format relative time
    function getRelativeTime(timestamp) {
      const now = Math.floor(Date.now() / 1000); // Current time in seconds
      const diff = now - timestamp;

      if (diff < 60) {
        return 'Baru saja';
      } else if (diff < 3600) {
        const minutes = Math.floor(diff / 60);
        return minutes === 1 ? '1 menit yang lalu' : `${minutes} menit yang lalu`;
      } else if (diff < 86400) {
        const hours = Math.floor(diff / 3600);
        return hours === 1 ? '1 jam yang lalu' : `${hours} jam yang lalu`;
      } else if (diff < 604800) {
        const days = Math.floor(diff / 86400);
        return days === 1 ? '1 hari yang lalu' : `${days} hari yang lalu`;
      } else if (diff < 2592000) {
        const weeks = Math.floor(diff / 604800);
        return weeks === 1 ? '1 minggu yang lalu' : `${weeks} minggu yang lalu`;
      } else {
        const months = Math.floor(diff / 2592000);
        return months === 1 ? '1 bulan yang lalu' : `${months} bulan yang lalu`;
      }
    }

    // Function to format full date time
    function getFullDateTime(timestamp) {
      const date = new Date(timestamp * 1000);
      const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
      };
      return new Intl.DateTimeFormat('id-ID', options).format(date);
    }

    // Update relative times
    function updateRelativeTime() {
      document.querySelectorAll('.time-relative').forEach(element => {
        const timestamp = parseInt(element.dataset.timestamp);
        const relativeTime = getRelativeTime(timestamp);
        const fullDateTime = getFullDateTime(timestamp);
        element.textContent = relativeTime;
        element.title = fullDateTime;
      });
    }

    // Initial update
    document.addEventListener('DOMContentLoaded', updateRelativeTime);

    // Update every 30 seconds for accuracy
    setInterval(updateRelativeTime, 30000);
  </script>
@endsection