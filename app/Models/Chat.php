<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $table = 'chats';
    
    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'isi_pesan',
        'waktu_kirim',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'waktu_kirim' => 'datetime',
    ];

    /**
     * Relasi dengan pengirim (User)
     */
    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    /**
     * Relasi dengan penerima (User)
     */
    public function penerima(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
