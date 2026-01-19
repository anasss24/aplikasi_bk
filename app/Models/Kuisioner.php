<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuisioner extends Model
{
    protected $table = 'kuisioners';
    protected $primaryKey = 'kuisioner_id';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'skor_total',
        'komentar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(KuisionerDetail::class, 'kuisioner_id');
    }
}
