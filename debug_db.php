<?php
$pdo = new PDO('mysql:host=localhost;dbname=aplikasi_bk', 'root', '');
echo "=== USERS ===\n";
$stmt = $pdo->query('SELECT id, name, role FROM users WHERE role IN ("guru_bk", "siswa") LIMIT 5');
foreach ($stmt as $row) {
    echo 'User ID: ' . $row['id'] . ', Name: ' . $row['name'] . ', Role: ' . $row['role'] . "\n";
}
echo "\n=== GURU_BK ===\n";
$stmt = $pdo->query('SELECT guru_id, user_id, nama FROM guru_bk LIMIT 5');
foreach ($stmt as $row) {
    echo 'Guru ID: ' . $row['guru_id'] . ', User ID: ' . $row['user_id'] . ', Nama: ' . $row['nama'] . "\n";
}
echo "\n=== SISWA ===\n";
$stmt = $pdo->query('SELECT id, user_id, nama_siswa FROM siswa LIMIT 5');
foreach ($stmt as $row) {
    echo 'Siswa ID: ' . $row['id'] . ', User ID: ' . $row['user_id'] . ', Nama: ' . $row['nama_siswa'] . "\n";
}
