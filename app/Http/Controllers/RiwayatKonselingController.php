<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKonseling;
use App\Models\JadwalKonseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RiwayatKonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'siswa') {
            // Siswa hanya bisa lihat riwayat konseling mereka sendiri
            $riwayat = RiwayatKonseling::whereHas('jadwal', function ($query) use ($user) {
                $query->where('siswa_id', $user->siswa_id ?? null);
            })->with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
        } else if ($user->role === 'guru_bk') {
            // Guru BK lihat riwayat konseling yang mereka tangani
            $riwayat = RiwayatKonseling::where('created_by', $user->guru_id ?? null)
                ->with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
        } else {
            // Admin bisa lihat semua
            $riwayat = RiwayatKonseling::with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
        }
        
        return view('riwayat.index', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($jadwal_id = null)
    {
        $jadwals = JadwalKonseling::where('status', 'disetujui')
            ->doesntHave('riwayat')
            ->with(['siswa', 'guru'])
            ->get();
            
        return view('riwayat.create', compact('jadwals', 'jadwal_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal_konseling,jadwal_id',
            'topik' => 'required|string|max:255',
            'isi_konseling' => 'required|string',
            'tindak_lanjut' => 'nullable|string',
            'status_tindak_lanjut' => 'nullable|in:belum_dilaksanakan,sedang_berjalan,selesai',
            'lampiran_url' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'tanggal_riwayat' => 'nullable|date',
        ]);

        $validated['created_by'] = Auth::user()->guru_id ?? Auth::id();
        
        if ($request->hasFile('lampiran_url')) {
            $file = $request->file('lampiran_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $filename);
            $validated['lampiran_url'] = 'lampiran/' . $filename;
        }

        if (!isset($validated['tanggal_riwayat'])) {
            $validated['tanggal_riwayat'] = now();
        }

        RiwayatKonseling::create($validated);

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat konseling berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatKonseling $riwayat)
    {
        $riwayat->load(['jadwal.siswa', 'jadwal.guru', 'guru']);
        return view('riwayat.show', compact('riwayat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatKonseling $riwayat)
    {
        $jadwals = JadwalKonseling::where('status', 'disetujui')
            ->with(['siswa', 'guru'])
            ->get();
            
        return view('riwayat.edit', compact('riwayat', 'jadwals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatKonseling $riwayat)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal_konseling,jadwal_id',
            'topik' => 'required|string|max:255',
            'isi_konseling' => 'required|string',
            'tindak_lanjut' => 'nullable|string',
            'status_tindak_lanjut' => 'nullable|in:belum_dilaksanakan,sedang_berjalan,selesai',
            'lampiran_url' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'tanggal_riwayat' => 'nullable|date',
        ]);

        if ($request->hasFile('lampiran_url')) {
            if ($riwayat->lampiran_url) {
                Storage::delete('public/' . $riwayat->lampiran_url);
            }
            $file = $request->file('lampiran_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lampiran', $filename);
            $validated['lampiran_url'] = 'lampiran/' . $filename;
        }

        $riwayat->update($validated);

        return redirect()->route('riwayat.show', $riwayat)
            ->with('success', 'Riwayat konseling berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatKonseling $riwayat)
    {
        if ($riwayat->lampiran_url) {
            Storage::delete('public/' . $riwayat->lampiran_url);
        }

        $riwayat->delete();

        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat konseling berhasil dihapus.');
    }
}
