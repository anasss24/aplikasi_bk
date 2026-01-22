@extends('layouts.app')

@section('content')
<div class="container-fluid" style="height: 100vh; display: flex; flex-direction: column; padding: 0; margin: 0; background: #f5f5f5;">
    <!-- Header -->
    <div class="bg-white border-bottom" style="padding: 16px 20px;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('chat.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; flex-shrink: 0;">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">
                        @if($displayName)
                            {{ $displayName }}
                        @else
                            {{ $otherUser->name ?? 'User' }}
                        @endif
                    </h5>
                    <small class="text-muted">
                        <i class="fas fa-circle" style="color: #198754; font-size: 6px;"></i> Online
                    </small>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-phone"></i>
                </button>
                <button class="btn btn-sm btn-outline-secondary" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-video"></i>
                </button>
                @if(auth()->user()->hasRole('guru_bk'))
                    <form id="selesaiForm" action="{{ route('chat.selesai', $otherUser->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="button" class="btn btn-sm btn-success" onclick="confirmSelesaiKonseling()" title="Selesai Konseling">
                            <i class="fas fa-flag-checkered"></i> Selesai
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div class="flex-grow-1" style="overflow-y: auto; padding: 20px; display: flex; flex-direction: column;" id="messagesContainer">
        @forelse($messages as $message)
            @if($message->pengirim_id == Auth::id())
                <!-- Pesan Dikirim -->
                <div class="d-flex justify-content-end mb-3">
                    <div style="max-width: 65%; background: linear-gradient(135deg, #007AFF, #0056B3); color: white; padding: 10px 14px; border-radius: 18px; word-wrap: break-word; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);">
                        <p class="mb-1" style="font-size: 14px;">{{ $message->isi_pesan }}</p>
                        <small style="opacity: 0.7; font-size: 12px;">{{ $message->waktu_kirim->format('H:i') }}</small>
                    </div>
                </div>
            @else
                <!-- Pesan Diterima -->
                <div class="d-flex justify-content-start mb-3">
                    <div style="max-width: 65%; background: white; color: #333; padding: 10px 14px; border-radius: 18px; word-wrap: break-word; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); border: 1px solid #e0e0e0;">
                        <p class="mb-1" style="font-size: 14px;">{{ $message->isi_pesan }}</p>
                        <small style="opacity: 0.6; font-size: 12px;">{{ $message->waktu_kirim->format('H:i') }}</small>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center text-muted my-auto">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-comments fa-2x opacity-50"></i>
                </div>
                <h6>Mulai Percakapan</h6>
                <p class="small">Kirim pesan pertama Anda kepada {{ $otherUser->name }}</p>
            </div>
        @endforelse
    </div>

    <!-- Input Area -->
    <div class="bg-white border-top" style="padding: 16px 20px;">
        <form id="chatForm" class="d-flex gap-3">
            @csrf
            <input type="hidden" name="penerima_id" value="{{ $otherUser->id }}">
            
            <button type="button" class="btn btn-outline-secondary" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fas fa-plus"></i>
            </button>
            
            <input type="text" name="isi_pesan" id="messageInput" class="form-control" 
                   placeholder="Aa" style="border-radius: 20px; border: 1px solid #d0d0d0; padding: 10px 16px;" required>
            
            <button type="submit" class="btn btn-primary" style="border-radius: 50%; width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div>
</div>

<script>
    const messagesContainer = document.getElementById('messagesContainer');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const receiverId = {{ $otherUser->id }};
    
    // Auto scroll ke bawah
    function scrollToBottom() {
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
    }

    // Load pesan baru secara real-time
    function loadMessages() {
        fetch(`/api/chat/{{ $otherUser->id }}/messages`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.messages && data.messages.length > 0) {
                const currentMessages = messagesContainer.querySelectorAll('[data-msg-id]').length;
                
                if (data.messages.length !== currentMessages) {
                    messagesContainer.innerHTML = '';
                    data.messages.forEach(msg => {
                        const isSent = msg.pengirim_id === {{ Auth::id() }};
                        const msgTime = new Date(msg.waktu_kirim).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
                        const msgHtml = `
                            <div class="d-flex justify-content-${isSent ? 'end' : 'start'} mb-3" data-msg-id="${msg.id}">
                                <div style="max-width: 65%; background: ${isSent ? 'linear-gradient(135deg, #007AFF, #0056B3)' : 'white'}; color: ${isSent ? 'white' : '#333'}; padding: 10px 14px; border-radius: 18px; word-wrap: break-word; box-shadow: 0 1px 2px rgba(0, 0, 0, ${isSent ? '0.1' : '0.05'}); ${!isSent ? 'border: 1px solid #e0e0e0;' : ''}">
                                    <p class="mb-1" style="font-size: 14px;">${msg.isi_pesan}</p>
                                    <small style="opacity: ${isSent ? '0.7' : '0.6'}; font-size: 12px;">${msgTime}</small>
                                </div>
                            </div>
                        `;
                        messagesContainer.innerHTML += msgHtml;
                    });
                    scrollToBottom();
                }
            }
        })
        .catch(error => console.error('Error loading messages:', error));
    }

    // Polling setiap 1 detik untuk real-time
    const pollInterval = setInterval(loadMessages, 1000);

    // Send pesan
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const messageText = messageInput.value.trim();
        if (!messageText) return;

        // Clear input immediately
        messageInput.value = '';
        messageInput.focus();

        fetch('{{ route("chat.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                penerima_id: receiverId,
                isi_pesan: messageText
            })
        })
        .then(response => response.json())
        .then(data => {
            loadMessages();
        })
        .catch(error => console.error('Error sending message:', error));
    });

    function confirmSelesaiKonseling() {
        Swal.fire({
            title: 'Selesai Konseling?',
            text: 'Setelah ini, sesi konseling akan ditandai sebagai selesai dan akan membuat riwayat konseling baru.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Selesai',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('selesaiForm').submit();
            }
        });
    }

    // Initial scroll
    scrollToBottom();

    // Cleanup
    window.addEventListener('unload', () => clearInterval(pollInterval));
</script>
@endsection
