@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Riwayat Konseling</h2>
        <p class="text-muted">Catatan semua sesi konseling</p>
      </div>
      <div class="col-md-4 text-end">
        @if((Auth::user()->role ?? null) === 'admin')
          <a href="{{ route('riwayat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Buat Riwayat
          </a>
        @endif
      </div>
    </div>

    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted small mb-1">Total Riwayat</p>
                <h4 class="mb-0">{{ $riwayat->total() }}</h4>
              </div>
              <i class="fas fa-file-alt text-primary" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>Siswa</th>
              <th>Topik</th>
              <th>Guru BK</th>
              <th>Tanggal</th>
              <th>Status Tindak Lanjut</th>
              <th>Dibuat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($riwayat as $r)
              <tr>
                <td>
                  <strong>{{ $r->siswa?->nama_siswa ?? ($r->jadwal?->siswa?->nama_siswa ?? 'N/A') }}</strong>
                </td>
                <td>{{ $r->topik }}</td>
                <td>{{ $r->guru?->nama ?? ($r->jadwal?->guru?->nama ?? 'N/A') }}</td>
                <td>{{ \Carbon\Carbon::parse($r->tanggal_riwayat)->format('d M Y') }}</td>
                <td>
                  @if($r->status_tindak_lanjut)
                    <span
                      class="badge bg-{{ $r->status_tindak_lanjut === 'selesai' ? 'success' : ($r->status_tindak_lanjut === 'perlu_follow_up' ? 'warning' : 'secondary') }}">
                      {{ ucfirst(str_replace('_', ' ', $r->status_tindak_lanjut)) }}
                    </span>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>
                <td>
                  <small class="time-relative" data-timestamp="{{ $r->created_at->timestamp }}" title="{{ $r->created_at->format('d F Y H:i') }}">
                    {{ $r->created_at->format('d M Y') }}
                  </small>
                </td>
                <td>
                  <div class="btn-group" role="group" style="gap: 5px;">
                    <a href="{{ route('riwayat.show', $r) }}" class="btn btn-outline-info" title="Lihat" style="min-width: 50px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                      <i class="fas fa-eye"></i>
                    </a>
                    @if((Auth::user()->role ?? null) === 'guru_bk' || (Auth::user()->role ?? null) === 'admin')
                      <a href="{{ route('riwayat.edit', $r) }}" class="btn btn-primary" title="Edit" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                        <i class="fas fa-edit me-2"></i>Edit
                      </a>
                      <form action="{{ route('riwayat.destroy', $r) }}" method="POST" style="display:inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Hapus" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                          <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                  Tidak ada data riwayat konseling
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer border-top">
        {{ $riwayat->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>

  <style>
    .stat-card {
      border-left: 4px solid #667eea;
    }

    .table-hover tbody tr:hover {
      background-color: #f5f5f5;
    }

    .btn-sm {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
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