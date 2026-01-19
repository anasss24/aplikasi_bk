@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('chat.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ $otherUser->name }}" alt="{{ $otherUser->name }}" class="rounded-circle me-3" width="40" height="40">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $otherUser->name }}</h6>
                            <small class="text-muted">{{ $otherUser->email }}</small>
                        </div>
                    </div>
                </div>

                <div class="card-body chat-messages" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
                    @foreach($messages as $message)
                        <div class="mb-3 d-flex {{ $message->pengirim_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="badge {{ $message->pengirim_id == Auth::id() ? 'bg-primary' : 'bg-secondary' }} p-3 rounded-3" style="max-width: 70%;">
                                <p class="mb-1 text-white">{{ $message->isi_pesan }}</p>
                                <small class="text-white-50">{{ $message->waktu_kirim->format('H:i') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer bg-white border-top">
                    <form action="{{ route('chat.store') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="penerima_id" value="{{ $otherUser->id }}">
                        <input type="text" name="isi_pesan" class="form-control" placeholder="Ketik pesan..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Scroll to bottom
    document.querySelector('.chat-messages').scrollTop = document.querySelector('.chat-messages').scrollHeight;
</script>
@endsection
