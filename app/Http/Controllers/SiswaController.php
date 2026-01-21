<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->paginate(15);
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis|min:1|digits_between:1,20',
            'nisn' => 'nullable|numeric|unique:siswa,nisn|min:1|digits_between:1,20',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'kelas_id' => 'required|exists:kelas,kelas_id',
        ], [
            'nis.numeric' => 'NIS harus berisi angka saja',
            'nis.unique' => 'NIS sudah terdaftar dalam sistem',
            'nis.digits_between' => 'NIS harus berisi 1-20 angka',
            'nisn.numeric' => 'NISN harus berisi angka saja',
            'nisn.unique' => 'NISN sudah terdaftar dalam sistem',
            'nisn.digits_between' => 'NISN harus berisi 1-20 angka',
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa->load('kelas');
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis,' . $siswa->siswa_id . ',siswa_id|min:1|digits_between:1,20',
            'nisn' => 'nullable|numeric|unique:siswa,nisn,' . $siswa->siswa_id . ',siswa_id|min:1|digits_between:1,20',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'kelas_id' => 'required|exists:kelas,kelas_id',
        ], [
            'nis.numeric' => 'NIS harus berisi angka saja',
            'nis.unique' => 'NIS sudah terdaftar dalam sistem',
            'nis.digits_between' => 'NIS harus berisi 1-20 angka',
            'nisn.numeric' => 'NISN harus berisi angka saja',
            'nisn.unique' => 'NISN sudah terdaftar dalam sistem',
            'nisn.digits_between' => 'NISN harus berisi 1-20 angka',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.show', $siswa)
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
