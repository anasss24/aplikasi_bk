<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = [
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'email',
        'jabatan',
        'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function konseling()
    {
        return $this->hasMany(Konseling::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }

    // Accessor untuk nama lengkap
    public function getNamaLengkapAttribute()
    {
        return $this->nama_guru;
    }

    // Scope untuk guru konselor
    public function scopeKonselor($query)
    {
        return $query->where('jabatan', 'konselor');
    }
}