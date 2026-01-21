<?php
$pdo = new PDO('mysql:host=localhost;dbname=aplikasi_bk', 'root', '');
$pdo->exec('UPDATE siswa SET user_id = 5 WHERE nama_siswa = "anass"');
echo "Updated siswa untuk anass\n";

// Verify
echo "\n=== SISWA AFTER UPDATE ===\n";
$stmt = $pdo->query('SELECT id, user_id, nama_siswa FROM siswa LIMIT 5');
foreach ($stmt as $row) {
    echo 'Siswa ID: ' . $row['id'] . ', User ID: ' . $row['user_id'] . ', Nama: ' . $row['nama_siswa'] . "\n";
}
