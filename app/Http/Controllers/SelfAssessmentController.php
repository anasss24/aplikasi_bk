<?php

namespace App\Http\Controllers;

use App\Models\SelfAssessment;
use App\Models\SelfAssessmentDetail;
use App\Models\PertanyaanAssessment;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfAssessmentController extends Controller
{
    /**
     * Tampilkan daftar self assessment
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'siswa') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            $assessments = SelfAssessment::where('siswa_id', $siswa->siswa_id ?? null)
                ->orderBy('tanggal_isi', 'desc')
                ->paginate(10);
        } else {
            $assessments = SelfAssessment::orderBy('tanggal_isi', 'desc')->paginate(10);
        }

        return view('assessment.index', compact('assessments'));
    }

    /**
     * Form tambah assessment baru
     */
    public function create()
    {
        $pertanyaan = PertanyaanAssessment::all();
        return view('assessment.create', compact('pertanyaan'));
    }

    /**
     * Simpan assessment baru
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'topik' => 'required|string|max:200',
            'isi_curhat' => 'required|string',
            'tingkat_stres' => 'required|integer|min:1|max:10',
            'jawaban' => 'array',
            'skor' => 'array',
        ]);

        $assessment = SelfAssessment::create([
            'siswa_id' => $siswa->siswa_id ?? null,
            'tanggal_isi' => now()->toDateString(),
            'topik' => $validated['topik'],
            'isi_curhat' => $validated['isi_curhat'],
            'tingkat_stres' => $validated['tingkat_stres'],
        ]);

        // Simpan detail jawaban
        if ($validated['jawaban'] ?? null) {
            foreach ($validated['jawaban'] as $key => $jawaban) {
                SelfAssessmentDetail::create([
                    'assessment_id' => $assessment->assessment_id,
                    'pertanyaan_id' => $key,
                    'jawaban' => $jawaban,
                    'skor' => $validated['skor'][$key] ?? 0,
                ]);
            }
        }

        return redirect()->route('assessment.index')
            ->with('success', 'Self Assessment berhasil disimpan!');
    }

    /**
     * Lihat detail assessment
     */
    public function show($id)
    {
        $assessment = SelfAssessment::findOrFail($id);
        $details = SelfAssessmentDetail::where('assessment_id', $id)->get();

        return view('assessment.show', compact('assessment', 'details'));
    }
}
