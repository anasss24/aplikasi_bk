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
        @if((Auth::user()->role ?? null) === 'guru_bk' || (Auth::user()->role ?? null) === 'admin')
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
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($riwayat as $r)
              <tr>
                <td>
                  <strong>{{ $r->jadwal->siswa->nama_siswa ?? 'N/A' }}</strong>
                </td>
                <td>{{ $r->topik }}</td>
                <td>{{ $r->jadwal->guru->nama ?? 'N/A' }}</td>
                <td>{{ $r->tanggal_riwayat->format('d M Y') }}</td>
                <td>
                  @if($r->status_tindak_lanjut)
                    <span
                      class="badge bg-{{ $r->status_tindak_lanjut === 'selesai' ? 'success' : ($r->status_tindak_lanjut === 'sedang_berjalan' ? 'warning' : 'secondary') }}">
                      {{ ucfirst(str_replace('_', ' ', $r->status_tindak_lanjut)) }}
                    </span>
                  @else
                    <span class="text-muted">-</span>
                  @endif
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
                      <form action="{{ route('riwayat.destroy', $r) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Hapus"
                          onclick="return confirm('Yakin ingin menghapus?')" style="min-width: 80px; height: 38px; display: flex; align-items: center; justify-content: center; padding: 6px 12px;">
                          <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
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
@endsection