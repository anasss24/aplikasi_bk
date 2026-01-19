<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'kelas_id',
        'status',
        'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'kelas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jadwalKonseling()
    {
        return $this->hasMany(JadwalKonseling::class, 'siswa_id', 'id');
    }

    public function konseling()
    {
        return $this->hasMany(Konseling::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    // Accessor untuk nama lengkap dengan gelar
    public function getNamaLengkapAttribute()
    {
        return $this->nama_siswa;
    }

    // Accessor untuk usia
    public function getUsiaAttribute()
    {
        return now()->diffInYears($this->tanggal_lahir);
    }
}