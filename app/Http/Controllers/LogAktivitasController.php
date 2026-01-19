<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogAktivitasController extends Controller
{
    /**
     * Tampilkan daftar log aktivitas (Admin only)
     */
    public function index()
    {
        $logs = LogAktivitas::with('user')
            ->orderBy('waktu', 'desc')
            ->paginate(20);

        return view('log-aktivitas.index', compact('logs'));
    }

    /**
     * Catat aktivitas ke database
     */
    public static function log($aksi, $deskripsi = null)
    {
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => $aksi,
            'deskripsi' => $deskripsi,
            'waktu' => now(),
        ]);
    }
}
