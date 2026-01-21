<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GuruBK extends Model
{
    protected $table = 'guru_bk';
    protected $primaryKey = 'guru_id';
    public $timestamps = true;
    protected $fillable = ['guru_id','user_id','nip','nama'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jadwals(){
        return $this->hasMany(JadwalKonseling::class, 'guru_id', 'guru_id');
    }
}
