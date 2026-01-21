<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Clear chat messages antara GuruBK dan User
$deletedCount = \DB::table('chats as c')
    ->join('users as pengirim', 'c.pengirim_id', '=', 'pengirim.id')
    ->join('users as penerima', 'c.penerima_id', '=', 'penerima.id')
    ->where(function($query) {
        $query->where(function($q) {
            $q->where('pengirim.role', 'guru_bk')
              ->where('penerima.role', 'user');
        })
        ->orWhere(function($q) {
            $q->where('pengirim.role', 'user')
              ->where('penerima.role', 'guru_bk');
        });
    })
    ->delete();

echo "Chat messages antara GuruBK dan User sudah dihapus! Total: $deletedCount pesan\n";
