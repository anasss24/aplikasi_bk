@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-md-8">
        <h2 class="mb-0">{{ $materi->judul }}</h2>
        <p class="text-muted">Materi BK</p>
      </div>
      <div class="col-md-4 text-end">
        @if(((Auth::user()->role ?? null) === 'guru_bk' && (Auth::user()->guru_id ?? null) === $materi->guru_id) || (Auth::user()->role ?? null) === 'admin')
          <a href="{{ route('materi.edit', $materi) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
          </a>
        @endif
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Kembali
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <!-- Konten Utama -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="mb-4">
              <span class="badge bg-info mb-3">{{ ucfirst($materi->kategori) }}</span>
              <h3>{{ $materi->judul }}</h3>
            </div>

            <div class="mb-4 pb-4 border-bottom">
              <small class="text-muted">
                <i class="fas fa-user"></i> <strong>{{ $materi->guru->nama ?? 'Admin' }}</strong>
              </small>
              <br>
              <small class="text-muted">
                <i class="fas fa-calendar"></i> {{ $materi->tanggal_upload->format('d F Y') }}
              </small>
              <br>
              <small class="text-muted">
                <i class="fas fa-eye"></i> {{ $materi->views ?? 0 }} views
              </small>
            </div>

            <h5>Deskripsi</h5>
            <p style="white-space: pre-wrap;">{{ $materi->deskripsi }}</p>

            @if($materi->file_url)
              <div class="mt-4">
                <h5 class="mb-3">File Materi</h5>
                <a href="{{ asset('storage/' . $materi->file_url) }}" class="btn btn-lg btn-primary" target="_blank">
                  <i class="fas fa-download"></i> Download Materi
                </a>
              </div>
            @endif

            @if($materi->url_eksternal)
              <div class="mt-3">
                <h5 class="mb-3">Akses Eksternal</h5>
                <a href="{{ $materi->url_eksternal }}" class="btn btn-lg btn-info" target="_blank">
                  <i class="fas fa-external-link-alt"></i> Buka Link Eksternal
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Informasi</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted d-block">Dibuat Oleh</small>
              <strong>{{ $materi->guru->nama ?? 'Admin' }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Tanggal Upload</small>
              <strong>{{ $materi->tanggal_upload->format('d F Y') }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Kategori</small>
              <strong>{{ ucfirst($materi->kategori) }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Jumlah Dilihat</small>
              <strong>{{ $materi->views ?? 0 }} views</strong>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-primary text-white">
            <h6 class="mb-0">Sistem</h6>
          </div>
          <div class="list-group list-group-flush">
            <div class="list-group-item">
              <small class="text-muted d-block">ID Materi</small>
              <strong>#{{ $materi->materi_id }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Dibuat</small>
              <strong>{{ $materi->created_at->format('d M Y H:i') }}</strong>
            </div>
            <div class="list-group-item">
              <small class="text-muted d-block">Diperbarui</small>
              <strong>{{ $materi->updated_at->format('d M Y H:i') }}</strong>
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