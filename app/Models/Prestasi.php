<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'jenis_prestasi',
        'tingkat',
        'nama_prestasi',
        'tanggal_prestasi',
        'deskripsi',
        'penyelenggara',
        'sertifikat'
    ];

    protected $casts = [
        'tanggal_prestasi' => 'date',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}