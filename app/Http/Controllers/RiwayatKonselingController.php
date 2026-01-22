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
            $siswa = \App\Models\Siswa::where('user_id', $user->id)->first();
            if ($siswa) {
                $riwayat = RiwayatKonseling::where('siswa_id', $siswa->id)
                    ->with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
            } else {
                $riwayat = collect([]);
            }
        } else if ($user->role === 'guru_bk') {
            // Guru BK lihat riwayat konseling yang mereka tangani
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if ($guru) {
                $riwayat = RiwayatKonseling::where('created_by', $guru->guru_id)
                    ->with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
            } else {
                $riwayat = collect([]);
            }
        } else {
            // Admin bisa lihat semua
            $riwayat = RiwayatKonseling::with(['jadwal.siswa', 'jadwal.guru', 'guru'])->paginate(15);
        }
        
        return view('riwayat.index', compact('riwayat'));
    }

    /**
     * Show the form for catatan sesi konseling
     */
    public function catat(RiwayatKonseling $riwayat)
    {
        $riwayat->load(['jadwal.siswa', 'jadwal.guru', 'guru']);
        return view('riwayat.catat', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $jadwal_id = $request->query('jadwal_id');
        
        // Ambil semua siswa untuk dropdown (bisa langsung pilih siswa)
        $siswa = \App\Models\Siswa::all();
        
        // Jika ada jadwal_id specific, ambil jadwal itu langsung (validate berstatus disetujui)
        $selectedJadwal = null;
        if ($jadwal_id) {
            $selectedJadwal = JadwalKonseling::where('jadwal_id', $jadwal_id)
                ->where('status', 'disetujui')
                ->with(['siswa', 'guru'])
                ->first();
            
            if (!$selectedJadwal) {
                return redirect()->route('riwayat.index')
                    ->with('error', 'Jadwal harus berstatus disetujui untuk membuat riwayat.');
            }
        }
        
        // Query jadwal yang disetujui dan belum ada riwayat untuk dropdown
        $query = JadwalKonseling::where('status', 'disetujui')
            ->doesntHave('riwayat')
            ->with(['siswa', 'guru']);
        
        // Jika guru_bk, hanya tampilkan jadwal mereka sendiri
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if ($guru) {
                $query = $query->where('guru_id', $guru->guru_id);
            }
        }
        
        $jadwals = $query->get();
        
        // Jika dari chat (ada jadwal_id), set sebagai "konseling online"
        $isFromChat = $jadwal_id ? true : false;
            
        return view('riwayat.create', compact('jadwals', 'jadwal_id', 'selectedJadwal', 'siswa', 'isFromChat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'tanggal_riwayat' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:5|max:180',
            'topik' => 'required|in:Akademik,Pribadi,Sosial,Perilaku,Karir,Bullying/Kekerasan,Keluarga,Lainnya',
            'metode' => 'required|in:tatap_muka,online',
            'lokasi' => 'nullable|in:ruang_bk,chat',
            'isi_konseling' => 'required|string',
            'progres' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'status_tindak_lanjut' => 'nullable|in:selesai,perlu_follow_up',
            'tanggal_follow_up' => 'nullable|date',
        ]);

        // Get guru_id dari relasi GuruBK
        $user = Auth::user();
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if (!$guru) {
                return redirect()->back()
                    ->with('error', 'Data guru BK tidak ditemukan. Hubungi admin.');
            }
            $validated['guru_id'] = $guru->guru_id;
            $validated['created_by'] = $guru->guru_id;
        } else {
            return redirect()->back()
                ->with('error', 'Hanya guru BK yang dapat membuat riwayat konseling.');
        }

        try {
            $riwayat = RiwayatKonseling::create($validated);

            // Jika ada jadwal_id, update status jadwal menjadi selesai
            if ($request->has('jadwal_id') && $request->jadwal_id) {
                $jadwal = JadwalKonseling::find($request->jadwal_id);
                if ($jadwal) {
                    $jadwal->status = 'selesai';
                    $jadwal->save();
                }
            }

            return redirect()->route('riwayat.index')
                ->with('success', 'Riwayat konseling berhasil dicatat dan jadwal konseling ditandai selesai.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan riwayat: ' . $e->getMessage())
                ->withInput();
        }
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
