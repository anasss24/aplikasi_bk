<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    /**
     * Display a listing of kelas
     */
    public function index()
    {
        $kelas = Kelas::with('jurusan')->latest()->get();
        $jurusan = Jurusan::all();
        return view('admin.kelas.index', compact('kelas', 'jurusan'));
    }

    /**
     * Show the form for creating a new kelas
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('admin.kelas.create', compact('jurusan'));
    }

    /**
     * Store a newly created kelas in storage
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('=== STORE REQUEST START ===');
        Log::info('Request data:', $request->all());
        
        $validated = $request->validate([
            'kode_kelas' => 'required|string|max:50|unique:kelas,kode_kelas',
            'nama_kelas' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tingkat' => 'required|integer|in:10,11,12',
        ], [
            'kode_kelas.required' => 'Kode kelas harus diisi',
            'kode_kelas.unique' => 'Kode kelas sudah ada',
            'nama_kelas.required' => 'Nama kelas harus diisi',
            'jurusan_id.required' => 'Jurusan harus dipilih',
            'jurusan_id.exists' => 'Jurusan tidak valid',
            'tingkat.required' => 'Tingkat harus dipilih',
            'tingkat.in' => 'Tingkat harus 10, 11, atau 12',
        ]);

        Log::info('Validated data:', $validated);
        
        try {
            $created = Kelas::create($validated);
            Log::info('Created kelas successfully:', $created->toArray());
        } catch (\Exception $e) {
            Log::error('Error creating kelas:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw $e;
        }
        
        Log::info('=== STORE REQUEST END ===');
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified kelas
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $jurusan = Jurusan::all();
        return view('admin.kelas.edit', compact('kelas', 'jurusan'));
    }

    /**
     * Update the specified kelas in storage
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
        
        $validated = $request->validate([
            'kode_kelas' => 'required|string|max:50|unique:kelas,kode_kelas,' . $kelas->kelas_id . ',kelas_id',
            'nama_kelas' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tingkat' => 'required|integer|in:10,11,12',
        ], [
            'kode_kelas.required' => 'Kode kelas harus diisi',
            'kode_kelas.unique' => 'Kode kelas sudah ada',
            'nama_kelas.required' => 'Nama kelas harus diisi',
            'jurusan_id.required' => 'Jurusan harus dipilih',
            'jurusan_id.exists' => 'Jurusan tidak valid',
            'tingkat.required' => 'Tingkat harus dipilih',
            'tingkat.in' => 'Tingkat harus 10, 11, atau 12',
        ]);

        $kelas->update($validated);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    /**
     * Remove the specified kelas from storage
     */
    public function destroy($id): RedirectResponse
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
