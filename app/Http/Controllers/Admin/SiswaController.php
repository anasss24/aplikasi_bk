<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with(['kelas', 'user'])->latest()->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'nullable|string|unique:siswa,nis',
            'nisn' => 'required|string|unique:siswa,nisn',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:siswa,email',
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'status' => 'nullable|in:aktif,tidak-aktif',
        ], [
            'nis.unique' => 'NIS sudah terdaftar',
            'nisn.required' => 'NISN wajib diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nama_siswa.required' => 'Nama siswa wajib diisi',
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
        ]);

        try {
            Siswa::create($validated);
            return redirect('/admin/siswa')->with('success', 'Data siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'nullable|string|unique:siswa,nis,' . $id,
            'nisn' => 'required|string|unique:siswa,nisn,' . $id,
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:siswa,email,' . $id,
            'kelas_id' => 'required|exists:kelas,kelas_id',
            'status' => 'nullable|in:aktif,tidak-aktif',
        ]);

        try {
            $siswa->update($validated);
            return redirect('/admin/siswa')->with('success', 'Data siswa berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data siswa: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            return redirect('/admin/siswa')->with('success', 'Data siswa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data siswa: ' . $e->getMessage());
        }
    }
}
