<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\JadwalKonseling;
use App\Models\RiwayatKonseling;
use App\Models\MateriBK;
use App\Models\GuruBK;
use App\Models\User;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // Cek jika user belum login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek jika user belum verifikasi OTP, redirect ke OTP
        if (!Auth::user()->is_verified) {
            return redirect('/verify-otp');
        }

        $user = Auth::user();
        $data = [];

        if ($user->role === 'siswa') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if ($siswa) {
                $data['jadwalKonseling'] = JadwalKonseling::where('siswa_id', $siswa->id)
                    ->where('jadwal_datetime', '>=', Carbon::now())
                    ->with(['guru', 'siswa'])
                    ->orderBy('jadwal_datetime')
                    ->limit(5)
                    ->get();

                $data['riwayatKonseling'] = RiwayatKonseling::where('siswa_id', $siswa->id)
                    ->with(['jadwal.guru', 'siswa'])
                    ->latest()
                    ->limit(5)
                    ->get();

                $data['materiTerbaru'] = MateriBK::orderBy('tanggal_upload', 'desc')
                    ->limit(6)
                    ->get();

                $data['totalJadwal'] = JadwalKonseling::where('siswa_id', $siswa->id)->count();
                $data['totalRiwayat'] = RiwayatKonseling::where('siswa_id', $siswa->id)->count();
            }
            return view('dashboard.siswa', $data);
        } elseif ($user->role === 'guru_bk') {
            $guru = GuruBK::where('user_id', $user->id)->first();
            if ($guru) {
                $data['totalSiswa'] = Siswa::whereHas('kelas')->count();

                $data['jadwalHariIni'] = JadwalKonseling::where('guru_id', $guru->guru_id)
                    ->whereDate('jadwal_datetime', Carbon::today())
                    ->with(['siswa'])
                    ->orderBy('jadwal_datetime')
                    ->get();

                $data['riwayatBulanIni'] = RiwayatKonseling::where('created_by', $guru->guru_id)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->with(['jadwal.siswa'])
                    ->latest()
                    ->limit(10)
                    ->get();

                $data['materiDiupload'] = MateriBK::where('guru_id', $guru->guru_id)
                    ->count();

                $data['totalRiwayat'] = RiwayatKonseling::where('created_by', $guru->guru_id)->count();
            }
            return view('dashboard.guru_bk', $data);
        } elseif ($user->role === 'admin') {
            $data['totalUser'] = Siswa::count();
            $data['totalSiswa'] = Siswa::count();
            $data['totalGuruBK'] = GuruBK::count();
            $data['totalSesiKonseling'] = JadwalKonseling::count();
            $data['totalJadwal'] = JadwalKonseling::count();
            $data['totalKelas'] = \App\Models\Kelas::count();

            $data['riwayatTerbaru'] = RiwayatKonseling::with(['jadwal.siswa', 'jadwal.guru'])
                ->latest()
                ->limit(10)
                ->get();

            $data['recentActivities'] = LogAktivitas::orderBy('waktu', 'desc')->limit(10)->get();

            return view('dashboard.admin', $data);
        }

        return view('home', $data);
    }
}