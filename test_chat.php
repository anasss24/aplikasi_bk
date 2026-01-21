<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$userId = 5; // User anass (siswa)
$user = \App\Models\User::findOrFail($userId);
$user->load('siswa', 'guru');

echo "User ID: " . $user->id . "\n";
echo "User Role: " . $user->role . "\n";
echo "User Name: " . $user->name . "\n";
echo "Has siswa: " . ($user->siswa ? "YES - " . $user->siswa->nama_siswa : "NO") . "\n";
echo "Has guru: " . ($user->guru ? "YES - " . $user->guru->nama : "NO") . "\n";

$displayName = $user->name;
if ($user->hasRole('siswa') && $user->siswa) {
    $displayName = $user->siswa->nama_siswa;
    echo "\nUsing siswa name: " . $displayName . "\n";
}
