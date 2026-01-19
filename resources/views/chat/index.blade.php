@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h2 fw-bold text-dark mb-0">Chat</h1>
            <p class="text-muted mb-0">Berkomunikasi dengan pengguna lain</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">Daftar Percakapan</h5>
                </div>
                <div class="card-body p-0">
                    @if($chats->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($chats as $userId => $messages)
                                <a href="{{ route('chat.show', $userId) }}" class="list-group-item list-group-item-action p-3 border-0 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $messages->first()->pengirim_id == Auth::id() ? $messages->first()->penerima->name : $messages->first()->pengirim->name }}</h6>
                                            <p class="text-muted small mb-0 text-truncate">{{ $messages->first()->isi_pesan }}</p>
                                        </div>
                                        <small class="text-muted ms-2">{{ $messages->first()->waktu_kirim->format('H:i') }}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-comments fa-2x mb-3 opacity-50"></i>
                            <p>Tidak ada percakapan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center text-muted py-5">
                    <i class="fas fa-comments fa-3x mb-3 opacity-25"></i>
                    <p>Pilih percakapan untuk memulai chat</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
