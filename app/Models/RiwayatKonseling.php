<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RiwayatKonseling extends Model
{
    protected $table = 'riwayat_konseling';
    protected $primaryKey = 'riwayat_id';
    public $timestamps = true;
    protected $fillable = ['riwayat_id','jadwal_id','topik','isi_konseling','tindak_lanjut','status_tindak_lanjut','lampiran_url','created_by','tanggal_riwayat'];

    public function jadwal(){ return $this->belongsTo(JadwalKonseling::class, 'jadwal_id', 'jadwal_id'); }
    public function guru(){ return $this->belongsTo(GuruBK::class, 'created_by', 'guru_id'); }
}
