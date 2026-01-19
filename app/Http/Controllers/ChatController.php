<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Tampilkan daftar percakapan
     */
    public function index()
    {
        $user = Auth::user();
        
        // Dapatkan semua percakapan unik dengan user lain
        $chats = Chat::where('pengirim_id', $user->id)
            ->orWhere('penerima_id', $user->id)
            ->orderBy('waktu_kirim', 'desc')
            ->get()
            ->groupBy(function ($chat) use ($user) {
                return $chat->pengirim_id == $user->id ? $chat->penerima_id : $chat->pengirim_id;
            });

        return view('chat.index', compact('chats'));
    }

    /**
     * Tampilkan percakapan dengan user tertentu
     */
    public function show($userId)
    {
        $currentUser = Auth::user();
        $otherUser = User::findOrFail($userId);

        $messages = Chat::where(function ($query) use ($currentUser, $userId) {
            $query->where('pengirim_id', $currentUser->id)
                ->where('penerima_id', $userId);
        })->orWhere(function ($query) use ($currentUser, $userId) {
            $query->where('pengirim_id', $userId)
                ->where('penerima_id', $currentUser->id);
        })->orderBy('waktu_kirim', 'asc')
            ->get();

        // Tandai pesan sebagai sudah dibaca
        Chat::where('penerima_id', $currentUser->id)
            ->where('pengirim_id', $userId)
            ->update(['is_read' => true]);

        return view('chat.show', compact('messages', 'otherUser'));
    }

    /**
     * Kirim pesan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'isi_pesan' => 'required|string|max:1000',
        ]);

        Chat::create([
            'pengirim_id' => Auth::id(),
            'penerima_id' => $validated['penerima_id'],
            'isi_pesan' => $validated['isi_pesan'],
            'waktu_kirim' => now(),
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan terkirim!');
    }
}
