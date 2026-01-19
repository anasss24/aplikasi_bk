<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    public $timestamps = true;
    protected $fillable = ['kode_kelas','nama_kelas','jurusan_id','tingkat'];
    protected $casts = [
        'tingkat' => 'integer',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }
}
