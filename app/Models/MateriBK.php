<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriBK extends Model
{
    use HasFactory;

    protected $table = 'materi_bk';
    protected $primaryKey = 'materi_id';
    public $timestamps = true;

    protected $fillable = [
        'guru_id',
        'judul',
        'deskripsi',
        'kategori',
        'file_url',
        'url_eksternal',
        'tanggal_upload',
        'views',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}