<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\JadwalKonseling;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $pendingVerification = User::where('is_verified', false)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalAdmins', 'pendingVerification'));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_verified' => 'nullable|boolean',
        ]);
        
        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function jurusan()
    {
        $jurusan = Jurusan::withCount('kelas')->latest()->get();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function laporan()
    {
        return view('admin.laporan.index');
    }

    public function laporanSiswa()
    {
        $siswa = Siswa::with('kelas.jurusan')->get();
        return view('admin.laporan.siswa', compact('siswa'));
    }

    public function laporanJadwal()
    {
        $jadwal = JadwalKonseling::with(['siswa', 'guru'])->get();
        return view('admin.laporan.jadwal', compact('jadwal'));
    }

    public function laporanPrestasi()
    {
        // Ambil data pelanggaran siswa
        try {
            $pelanggaran = Pelanggaran::with('siswa')->latest()->get();
        } catch (\Exception $e) {
            $pelanggaran = collect([]);
        }
        return view('admin.laporan.prestasi', compact('pelanggaran'));
    }
}