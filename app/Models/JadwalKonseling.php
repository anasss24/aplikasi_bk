<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalKonseling extends Model
{
    protected $table = 'jadwal_konseling';
    protected $primaryKey = 'jadwal_id';
    public $timestamps = true;
    protected $fillable = [
      'jadwal_id','siswa_id','guru_id','jadwal_datetime','status','catatan_admin','approved_by','lokasi','metode','masalah'
    ];

    protected function casts(): array
    {
        return [
            'jadwal_datetime' => 'datetime',
        ];
    }

    public function getRouteKeyName()
    {
        return 'jadwal_id';
    }

    public function siswa(){ return $this->belongsTo(Siswa::class, 'siswa_id', 'id'); }
    public function guru(){ return $this->belongsTo(GuruBK::class, 'guru_id', 'guru_id'); }
    public function approvedBy(){ return $this->belongsTo(User::class, 'approved_by', 'id'); }
    public function riwayat(){ return $this->hasMany(RiwayatKonseling::class, 'jadwal_id', 'jadwal_id'); }
}
