<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KuisionerDetail extends Model
{
    protected $table = 'kuisioner_details';

    protected $fillable = [
        'kuisioner_id',
        'pertanyaan_id',
        'jawaban',
        'skor',
    ];

    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(Kuisioner::class, 'kuisioner_id');
    }

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(PertanyaanKuisioner::class, 'pertanyaan_id');
    }
}
