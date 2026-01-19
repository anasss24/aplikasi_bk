<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JadwalKonseling;
use App\Models\Siswa;
use App\Models\GuruBK;
use Auth;

class JadwalController extends Controller
{
    public function index(){
        // semua jadwal (bisa filter by role)
        $jadwals = JadwalKonseling::with(['siswa','guru','approvedBy'])->orderBy('jadwal_datetime','desc')->paginate(15);
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
            'metode'=>'required|in:offline,online'
        ]);
        $data['status'] = 'diajukan';
        // pastikan ID jadwal unik; jika auto-increment DB, biarkan kosong
        $jadwal = JadwalKonseling::create($data);
        // log aktivitas bisa ditambahkan
        return redirect()->route('jadwal.index')->with('success','Jadwal diajukan.');
    }

    public function approve(Request $req, $jadwal_id){
        $jadwal = JadwalKonseling::findOrFail($jadwal_id);
        $jadwal->status = 'disetujui';
        $jadwal->approved_by = Auth::id(); // pastikan user login admin/guru
        $jadwal->save();
        return back()->with('success','Jadwal disetujui.');
    }

    public function cancel($id){
        $jadwal = JadwalKonseling::findOrFail($id);
        $jadwal->status = 'batal';
        $jadwal->save();
        return back()->with('success','Jadwal dibatalkan.');
    }

    public function show($id){
        $jadwal = JadwalKonseling::with(['siswa','guru','approvedBy'])->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit($id){
        $jadwal = JadwalKonseling::findOrFail($id);
        $siswaList = Siswa::all();
        $guruList = GuruBK::all();
        return view('jadwal.edit', compact('jadwal','siswaList','guruList'));
    }

    public function update(Request $req, $id){
        $jadwal = JadwalKonseling::findOrFail($id);
        $data = $req->validate([
            'siswa_id'=>'required|integer',
            'guru_id'=>'required|integer',
            'jadwal_datetime'=>'required|date',
            'lokasi'=>'nullable|string',
            'metode'=>'required|in:offline,online'
        ]);
        $jadwal->update($data);
        return redirect()->route('jadwal.index')->with('success','Jadwal diperbarui.');
    }

    public function destroy($id){
        $jadwal = JadwalKonseling::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success','Jadwal dihapus.');
    }
}
