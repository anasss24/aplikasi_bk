<?php

$testEmail = 'test@example.com';

// Test 1: Create a user
echo "=== Test 1: Creating user ===\n";
$output = shell_exec('cd c:\\Users\\PC_07\\aplikasi_bk && php artisan tinker <<< "
\\$user = \\App\\Models\\User::firstOrCreate(
    [\'email\' => \'test@example.com\'],
    [
        \'name\' => \'Test User\',
        \'password\' => bcrypt(\'password123\'),
        \'email_verified_at\' => now()
    ]
);
echo \'User created/found: \' . \\$user->email . \" (ID: \" . \\$user->id . \")\\n\";
exit;
"');
echo $output;

// Test 2: Direct HTTP request
echo "\n=== Test 2: Direct request to /forgot-password ===\n";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1:8000/forgot-password',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HEADER => true,
    CURLOPT_TIMEOUT => 10,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $httpCode\n";
echo "Response snippet:\n";
echo substr($response, 0, 500) . "\n";

// Test 3: Check if server is running
echo "\n=== Test 3: Checking if Laravel server is running ===\n";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://127.0.0.1:8000/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "Server not accessible: $error\n";
} else {
    echo "Server is running (HTTP $httpCode)\n";
}
