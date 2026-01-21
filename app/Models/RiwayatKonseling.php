<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RiwayatKonseling extends Model
{
    protected $table = 'riwayat_konseling';
    protected $primaryKey = 'riwayat_id';
    public $timestamps = true;
    protected $casts = [
        'tanggal_riwayat' => 'date',
        'tanggal_follow_up' => 'date',
    ];
    protected $fillable = [
        'riwayat_id',
        'siswa_id',
        'guru_id',
        'tanggal_riwayat',
        'waktu_mulai',
        'durasi',
        'topik',
        'metode',
        'lokasi',
        'isi_konseling',
        'progres',
        'tindak_lanjut',
        'status_tindak_lanjut',
        'tanggal_follow_up',
        'lampiran_url',
        'jadwal_id',
        'created_by'
    ];

    public function jadwal(){ return $this->belongsTo(JadwalKonseling::class, 'jadwal_id', 'jadwal_id'); }
    public function guru(){ return $this->belongsTo(GuruBK::class, 'created_by', 'guru_id'); }
    public function siswa(){ return $this->belongsTo(Siswa::class, 'siswa_id', 'id'); }
}
