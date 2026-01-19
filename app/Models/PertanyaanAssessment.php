<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanAssessment extends Model
{
    protected $table = 'pertanyaan_assessments';
    protected $primaryKey = 'pertanyaan_id';

    protected $fillable = [
        'teks',
        'kategori',
    ];

    public $timestamps = false;
}
