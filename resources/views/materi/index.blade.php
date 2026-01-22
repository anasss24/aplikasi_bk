@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">Materi BK</h2>
        <p class="text-muted">Koleksi materi bimbingan dan konseling</p>
      </div>
      <div class="col-md-4 text-end">
        @if((Auth::user()->role ?? null) === 'guru_bk' || (Auth::user()->role ?? null) === 'admin')
          <a href="{{ route('materi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Unggah Materi
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

    <!-- Stats -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card stat-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-muted small mb-1">Total Materi</p>
                <h4 class="mb-0">{{ $materi->total() }}</h4>
              </div>
              <i class="fas fa-book text-primary" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grid View -->
    <div class="row">
      @forelse($materi as $m)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <h6 class="card-title">{{ $m->judul }}</h6>
                <span class="badge bg-info">{{ ucfirst($m->kategori) }}</span>
              </div>

              <p class="card-text text-muted small">{{ Str::limit($m->deskripsi, 100) }}</p>

              <div class="mb-3">
                <small class="text-muted">
                  <i class="fas fa-user"></i> {{ $m->guru->nama ?? 'Guru BK' }}
                </small>
                <br>
                <small class="text-muted">
                  <i class="fas fa-calendar"></i> {{ $m->tanggal_upload->format('d M Y') }}
                </small>
              </div>

              <div class="mb-3">
                <span class="badge bg-secondary">
                  <i class="fas fa-eye"></i> {{ $m->views ?? 0 }} views
                </span>
              </div>

              <div class="btn-group w-100" role="group" style="gap: 5px;">
                <a href="{{ route('materi.show', $m) }}" class="btn btn-outline-primary" style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;" title="Lihat">
                  <i class="fas fa-eye"></i>
                </a>
                @php
                  $currentUserGuruId = null;
                  if ((Auth::user()->role ?? null) === 'guru_bk') {
                    $guru = \App\Models\GuruBK::where('user_id', Auth::id())->first();
                    $currentUserGuruId = $guru?->guru_id;
                  }
                  $canEdit = ((Auth::user()->role ?? null) === 'guru_bk' && $currentUserGuruId === $m->guru_id) || (Auth::user()->role ?? null) === 'admin';
                @endphp
                @if($canEdit)
                  <a href="{{ route('materi.edit', $m) }}" class="btn btn-primary" style="flex: 0 0 80px; display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;">
                    <i class="fas fa-edit me-2"></i> Edit
                  </a>
                  <form action="{{ route('materi.destroy', $m) }}" method="POST" style="display:inline; width: 80px;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100" style="display: flex; align-items: center; justify-content: center; padding: 6px 12px; height: 38px;" data-delete-message="Yakin ingin menghapus materi <strong>{{ $m->judul }}</strong>?">
                      <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      @empty
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
      <div class="col-12">
        {{ $materi->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </div>

  <style>
    .stat-card {
      border-left: 4px solid #667eea;
    }

    .card {
      transition: none;
    }

    .card:hover {
      transform: none;
      box-shadow: none !important;
    }

    .btn {
      background-color: #0066cc !important;
      color: white !important;
      border: none !important;
    }

    .btn:hover, .btn:focus, .btn:active, .btn.active {
      background-color: #0066cc !important;
      color: white !important;
      border: none !important;
      box-shadow: none !important;
      outline: none !important;
    }
  </style>
@endsection