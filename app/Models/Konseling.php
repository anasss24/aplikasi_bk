<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'tanggal_konseling',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_konseling',
        'masalah',
        'tindakan',
        'status',
        'catatan'
    ];

    protected $casts = [
        'tanggal_konseling' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Accessor untuk durasi konseling
    public function getDurasiAttribute()
    {
        $start = \Carbon\Carbon::parse($this->waktu_mulai);
        $end = \Carbon\Carbon::parse($this->waktu_selesai);
        return $start->diffInMinutes($end);
    }
}