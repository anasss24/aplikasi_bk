<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelfAssessmentDetail extends Model
{
    protected $table = 'self_assessment_details';

    protected $fillable = [
        'assessment_id',
        'pertanyaan_id',
        'jawaban',
        'skor',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(SelfAssessment::class, 'assessment_id');
    }

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(PertanyaanAssessment::class, 'pertanyaan_id');
    }
}
