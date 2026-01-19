<?php

namespace App\Http\Controllers;

use App\Models\Kuisioner;
use App\Models\KuisionerDetail;
use App\Models\PertanyaanKuisioner;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisionerController extends Controller
{
    /**
     * Tampilkan daftar kuisioner
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'siswa') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            $kuisioners = Kuisioner::where('siswa_id', $siswa->siswa_id ?? null)
                ->orderBy('tanggal', 'desc')
                ->paginate(10);
        } else {
            $kuisioners = Kuisioner::orderBy('tanggal', 'desc')->paginate(10);
        }

        return view('kuisioner.index', compact('kuisioners'));
    }

    /**
     * Form isi kuisioner baru
     */
    public function create()
    {
        $pertanyaan = PertanyaanKuisioner::all();
        return view('kuisioner.create', compact('pertanyaan'));
    }

    /**
     * Simpan kuisioner
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'komentar' => 'nullable|string',
            'jawaban' => 'array',
            'skor' => 'array',
        ]);

        $skorTotal = array_sum($validated['skor'] ?? []);

        $kuisioner = Kuisioner::create([
            'siswa_id' => $siswa->siswa_id ?? null,
            'tanggal' => now()->toDateString(),
            'skor_total' => $skorTotal,
            'komentar' => $validated['komentar'] ?? null,
        ]);

        // Simpan detail jawaban
        if ($validated['jawaban'] ?? null) {
            foreach ($validated['jawaban'] as $key => $jawaban) {
                KuisionerDetail::create([
                    'kuisioner_id' => $kuisioner->kuisioner_id,
                    'pertanyaan_id' => $key,
                    'jawaban' => $jawaban,
                    'skor' => $validated['skor'][$key] ?? 0,
                ]);
            }
        }

        return redirect()->route('kuisioner.index')
            ->with('success', 'Kuisioner berhasil disimpan!');
    }

    /**
     * Lihat detail kuisioner
     */
    public function show($id)
    {
        $kuisioner = Kuisioner::findOrFail($id);
        $details = KuisionerDetail::where('kuisioner_id', $id)->get();

        return view('kuisioner.show', compact('kuisioner', 'details'));
    }
}
