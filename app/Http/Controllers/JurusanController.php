<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jurusan' => 'required|string|unique:jurusan,kode_jurusan',
            'nama_jurusan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        Jurusan::create($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode_jurusan' => 'required|string|unique:jurusan,kode_jurusan,' . $jurusan->id,
            'nama_jurusan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        $jurusan->update($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
