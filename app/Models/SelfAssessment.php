<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SelfAssessment extends Model
{
    protected $table = 'self_assessments';
    protected $primaryKey = 'assessment_id';

    protected $fillable = [
        'siswa_id',
        'tanggal_isi',
        'topik',
        'isi_curhat',
        'tingkat_stres',
    ];

    protected $casts = [
        'tanggal_isi' => 'date',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(SelfAssessmentDetail::class, 'assessment_id');
    }
}
