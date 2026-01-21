<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Simulasi guru (user 2) membuka chat dengan siswa (user 5)
$userId = 5; // Siswa
$otherUser = \App\Models\User::findOrFail($userId);
$otherUser->load('siswa', 'guru');

echo "=== CHAT SIMULATION ===\n";
echo "Other User ID: " . $otherUser->id . "\n";
echo "Other User Role: " . $otherUser->role . "\n";
echo "Other User Name: " . $otherUser->name . "\n";
echo "Has siswa relation: " . ($otherUser->siswa ? "YES" : "NO") . "\n";
if ($otherUser->siswa) {
    echo "Siswa nama: " . $otherUser->siswa->nama_siswa . "\n";
}
echo "Has guru relation: " . ($otherUser->guru ? "YES" : "NO") . "\n";
if ($otherUser->guru) {
    echo "Guru nama: " . $otherUser->guru->nama . "\n";
}

$displayName = $otherUser->name;

if ($otherUser->hasRole('guru_bk') && $otherUser->guru) {
    $displayName = $otherUser->guru->nama;
    echo "\nUsing guru name: " . $displayName . "\n";
} 
else if ($otherUser->hasRole('siswa') && $otherUser->siswa) {
    $displayName = $otherUser->siswa->nama_siswa;
    echo "\nUsing siswa name: " . $displayName . "\n";
}

echo "\nFinal displayName: " . $displayName . "\n";
