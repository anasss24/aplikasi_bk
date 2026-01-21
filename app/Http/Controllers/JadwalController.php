<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JadwalKonseling;
use App\Models\RiwayatKonseling;
use App\Models\Siswa;
use App\Models\GuruBK;
use Auth;

class JadwalController extends Controller
{
    public function index(){
        // Filter berdasarkan role user
        $user = Auth::user();
        
        if ($user->role === 'guru_bk') {
            // Guru BK hanya lihat jadwal yang ditujukan ke mereka dan menunggu persetujuan
            $guru = GuruBK::where('user_id', $user->id)->first();
            if ($guru) {
                $jadwals = JadwalKonseling::where('guru_id', $guru->guru_id)
                    ->with(['siswa','guru','approvedBy'])
                    ->orderBy('jadwal_datetime','desc')
                    ->paginate(15);
            } else {
                $jadwals = collect([]);
            }
        } else {
            // Admin dan user/siswa lihat semua jadwal
            $jadwals = JadwalKonseling::with(['siswa','guru','approvedBy'])
                ->orderBy('jadwal_datetime','desc')
                ->paginate(15);
        }
        
        return view('jadwal.index', compact('jadwals'));
    }

    public function create(){
        $siswaList = Siswa::all();
        $guruList = GuruBK::all();
        return view('jadwal.create', compact('siswaList','guruList'));
    }

    public function store(Request $req){
        $data = $req->validate([
            'siswa_id'=>'required|integer',
            'guru_id'=>'required|integer',
            'jadwal_datetime'=>'required|date',
            'lokasi'=>'nullable|string',
            'metode'=>'required|in:offline,online',
            'masalah'=>'nullable|string'
        ]);
        $data['status'] = 'diajukan';
        // pastikan ID jadwal unik; jika auto-increment DB, biarkan kosong
        $jadwal = JadwalKonseling::create($data);
        // log aktivitas bisa ditambahkan
        return redirect()->route('jadwal.index')->with('success','Jadwal diajukan.');
    }

    public function approve(JadwalKonseling $jadwal){
        $jadwal->status = 'disetujui';
        $jadwal->approved_by = Auth::id();
        $jadwal->save();
        
        return redirect()->route('jadwal.show', $jadwal->jadwal_id)
            ->with('success','Jadwal disetujui. Silakan lakukan sesi konseling melalui chat, kemudian klik Selesai untuk mencatat riwayat.');
    }

    public function reject(JadwalKonseling $jadwal){
        $jadwal->status = 'ditolak';
        $jadwal->approved_by = Auth::id();
        $jadwal->save();
        return back()->with('success','Jadwal ditolak.');
    }

    public function cancel(JadwalKonseling $jadwal){
        $jadwal->status = 'batal';
        $jadwal->save();
        return back()->with('success','Jadwal dibatalkan.');
    }

    public function show(JadwalKonseling $jadwal){
        $jadwal->load(['siswa.user', 'guru.user', 'approvedBy']);
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalKonseling $jadwal){
        $siswaList = Siswa::all();
        $guruList = GuruBK::all();
        return view('jadwal.edit', compact('jadwal','siswaList','guruList'));
    }

    public function update(Request $req, JadwalKonseling $jadwal){
        $data = $req->validate([
            'siswa_id'=>'required|integer',
            'guru_id'=>'required|integer',
            'jadwal_datetime'=>'required|date',
            'lokasi'=>'nullable|string',
            'metode'=>'required|in:offline,online',
            'masalah'=>'nullable|string'
        ]);
        $jadwal->update($data);
        return redirect()->route('jadwal.index')->with('success','Jadwal diperbarui.');
    }

    public function destroy(JadwalKonseling $jadwal){
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success','Jadwal dihapus.');
    }

    public function selesai(JadwalKonseling $jadwal){
        $user = Auth::user();
        $guru = GuruBK::where('user_id', $user->id)->first();
        
        if (!$guru || $jadwal->guru_id != $guru->guru_id) {
            return back()->with('error','Anda tidak memiliki akses untuk menyelesaikan jadwal ini.');
        }

        if ($jadwal->status !== 'disetujui') {
            return back()->with('error','Hanya jadwal yang disetujui yang dapat diselesaikan.');
        }

        // Buat riwayat konseling otomatis
        $riwayat = RiwayatKonseling::create([
            'siswa_id' => $jadwal->siswa_id,
            'guru_id' => $jadwal->guru_id,
            'tanggal_riwayat' => now()->toDateString(),
            'waktu_mulai' => $jadwal->jadwal_datetime->format('H:i'),
            'durasi' => 60, // default 60 menit
            'topik' => $this->getMasalahLabel($jadwal->masalah),
            'metode' => $jadwal->metode,
            'lokasi' => $jadwal->lokasi,
            'isi_konseling' => '', // Kosong, akan diisi guru nanti
            'progres' => 'belum_dinilai',
            'tindak_lanjut' => '',
            'status_tindak_lanjut' => 'belum_dilakukan',
            'jadwal_id' => $jadwal->jadwal_id,
            'created_by' => $guru->guru_id
        ]);

        // Update status jadwal menjadi selesai
        $jadwal->status = 'selesai';
        $jadwal->save();

        return redirect()->route('riwayat.catat', $riwayat->riwayat_id)
            ->with('success','Sesi konseling berhasil dicatat. Silakan lengkapi detail konseling.');
    }

    private function getMasalahLabel($masalah){
        $masalahList = [
            'masalah_akademik' => 'Masalah Akademik',
            'masalah_keluarga' => 'Masalah Keluarga',
            'masalah_sosial' => 'Masalah Sosial',
            'masalah_emosional' => 'Masalah Emosional',
            'masalah_karir' => 'Masalah Karir & Masa Depan',
            'masalah_pribadi' => 'Masalah Pribadi',
            'masalah_kesehatan' => 'Masalah Kesehatan & Kebiasaan',
            'masalah_disiplin' => 'Masalah Disiplin & Tata Tertib',
            'lainnya' => 'Lainnya'
        ];
        return $masalahList[$masalah] ?? 'Topik Konseling';
    }
}
