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
        $allChats = Chat::where('pengirim_id', $user->id)
            ->orWhere('penerima_id', $user->id)
            ->orderBy('waktu_kirim', 'asc')  // ascending untuk group
            ->get();

        // Group by user (the other person in the conversation)
        $chats = $allChats->groupBy(function ($chat) use ($user) {
            return $chat->pengirim_id == $user->id ? $chat->penerima_id : $chat->pengirim_id;
        });

        // Reverse setiap group agar pesan terbaru di depan, lalu sort groups by latest message
        $chats = $chats->map(function ($group) {
            return $group->reverse()->values();  // Reverse agar terbaru di index 0
        })->sortBy(function ($group) {
            return -$group->first()->waktu_kirim->timestamp;  // Sort groups by latest
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
        
        // Ambil nama dari relasi user yang sebenarnya
        $otherUser->load('siswa', 'guru');
        
        \Log::info('=== CHAT DEBUG ===');
        \Log::info('Other User ID: ' . $otherUser->id);
        \Log::info('Other User Role: ' . $otherUser->role);
        \Log::info('Other User Name: ' . $otherUser->name);
        \Log::info('Has siswa relation: ' . ($otherUser->siswa ? 'YES' : 'NO'));
        if ($otherUser->siswa) {
            \Log::info('Siswa nama: ' . $otherUser->siswa->nama_siswa);
        }
        \Log::info('Has guru relation: ' . ($otherUser->guru ? 'YES' : 'NO'));
        if ($otherUser->guru) {
            \Log::info('Guru nama: ' . $otherUser->guru->nama);
        }
        
        $displayName = $otherUser->name;
        
        if ($otherUser->hasRole('guru_bk') && $otherUser->guru) {
            $displayName = $otherUser->guru->nama;
            \Log::info('Using guru name: ' . $displayName);
        } 
        else if ($otherUser->hasRole('siswa') && $otherUser->siswa) {
            $displayName = $otherUser->siswa->nama_siswa;
            \Log::info('Using siswa name: ' . $displayName);
        }

        \Log::info('Final displayName: ' . $displayName);

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

        return view('chat.show', compact('messages', 'otherUser', 'displayName'));
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

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Pesan terkirim!']);
        }

        return back()->with('success', 'Pesan terkirim!');
    }

    /**
     * Get messages untuk real-time polling
     */
    public function getMessages($userId)
    {
        $currentUser = Auth::user();
        
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

        return response()->json([
            'messages' => $messages->map(function($msg) {
                return [
                    'id' => $msg->id,
                    'pengirim_id' => $msg->pengirim_id,
                    'penerima_id' => $msg->penerima_id,
                    'isi_pesan' => $msg->isi_pesan,
                    'waktu_kirim' => $msg->waktu_kirim,
                    'is_read' => $msg->is_read,
                ];
            })
        ]);
    }

    /**
     * Selesai konseling - redirect ke form hasil konseling
     */
    public function selesai($userId)
    {
        $currentUser = Auth::user();

        // Hanya guru BK yang bisa menyelesaikan konseling
        if (!$currentUser->hasRole('guru_bk')) {
            return redirect()->back()->with('error', 'Hanya guru BK yang dapat menyelesaikan konseling');
        }

        // Cari jadwal konseling yang sedang berlangsung antara guru ini dan siswa
        $siswa = User::findOrFail($userId);
        $jadwal = \App\Models\JadwalKonseling::where('guru_id', $currentUser->guru->guru_id)
            ->where('siswa_id', $siswa->siswa->id ?? null)
            ->where('status', 'disetujui')
            ->latest()
            ->first();

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal konseling tidak ditemukan atau sudah selesai');
        }

        // Redirect ke form hasil konseling dengan membawa jadwal_id
        return redirect()->route('riwayat.create', ['jadwal_id' => $jadwal->jadwal_id])->with('success', 'Silakan isi form hasil konseling');
    }
}
