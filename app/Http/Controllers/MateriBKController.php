<?php

namespace App\Http\Controllers;

use App\Models\MateriBK;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriBKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = MateriBK::with('guru')->latest()->paginate(15);
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:kelas10,kelas11,kelas12,umum',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
            'url_eksternal' => 'nullable|url',
            'tanggal_upload' => 'nullable|date',
        ]);

        // Dapatkan guru_id dari relasi GuruBK
        $user = Auth::user();
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if (!$guru) {
                return redirect()->back()->with('error', 'Guru BK tidak ditemukan. Hubungi admin.');
            }
            $validated['guru_id'] = $guru->guru_id;
        } else {
            return redirect()->back()->with('error', 'Hanya guru BK yang dapat upload materi.');
        }
        
        if ($request->hasFile('file_url')) {
            $file = $request->file('file_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/materi', $filename);
            $validated['file_url'] = 'materi/' . $filename;
        }

        if (!isset($validated['tanggal_upload'])) {
            $validated['tanggal_upload'] = now()->toDateString();
        }

        MateriBK::create($validated);

        return redirect()->route('materi.index')
            ->with('success', 'Materi BK berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MateriBK $materi)
    {
        $materi->load('guru');
        $materi->increment('views'); // Track views
        return view('materi.show', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MateriBK $materi)
    {
        // Hanya creator atau admin yang bisa edit
        $user = Auth::user();
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if (!$guru || $guru->guru_id !== $materi->guru_id) {
                abort(403);
            }
        } elseif ($user->role !== 'admin') {
            abort(403);
        }
        
        return view('materi.edit', compact('materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MateriBK $materi)
    {
        // Hanya creator atau admin yang bisa update
        $user = Auth::user();
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if (!$guru || $guru->guru_id !== $materi->guru_id) {
                abort(403);
            }
        } elseif ($user->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:kelas10,kelas11,kelas12,umum',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
            'url_eksternal' => 'nullable|url',
        ]);

        if ($request->hasFile('file_url')) {
            if ($materi->file_url) {
                Storage::delete('public/' . $materi->file_url);
            }
            $file = $request->file('file_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/materi', $filename);
            $validated['file_url'] = 'materi/' . $filename;
        }

        $materi->update($validated);

        return redirect()->route('materi.show', $materi)
            ->with('success', 'Materi BK berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MateriBK $materi)
    {
        // Hanya creator atau admin yang bisa delete
        $user = Auth::user();
        if ($user->role === 'guru_bk') {
            $guru = \App\Models\GuruBK::where('user_id', $user->id)->first();
            if (!$guru || $guru->guru_id !== $materi->guru_id) {
                abort(403);
            }
        } elseif ($user->role !== 'admin') {
            abort(403);
        }

        if ($materi->file_url) {
            Storage::delete('public/' . $materi->file_url);
        }

        $materi->delete();

        return redirect()->route('materi.index')
            ->with('success', 'Materi BK berhasil dihapus.');
    }

    /**
     * Download file materi
     */
    public function download(MateriBK $materi)
    {
        if (!$materi->file_url || !Storage::disk('public')->exists($materi->file_url)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($materi->file_url);
    }
}
