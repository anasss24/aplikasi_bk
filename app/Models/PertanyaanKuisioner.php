<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanKuisioner extends Model
{
    protected $table = 'pertanyaan_kuisioners';
    protected $primaryKey = 'pertanyaan_id';

    protected $fillable = [
        'teks',
        'kategori',
    ];

    public $timestamps = false;
}
