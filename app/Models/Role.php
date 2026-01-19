<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    protected $fillable = ['role_id','role_name'];

    public function users(){
        return $this->belongsToMany(User::class, 'User_Roles', 'role_id', 'user_id');
    }
}
