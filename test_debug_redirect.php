<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Test accessing /forgot-password with more debug info
$request = \Illuminate\Http\Request::create('/forgot-password', 'GET');
$response = $kernel->handle($request);

$status = $response->getStatusCode();
echo "Response Status: $status\n";
echo "Response Headers:\n";
foreach ($response->headers->all() as $key => $value) {
    echo "  $key: " . implode(', ', $value) . "\n";
}

if ($status === 302) {
    echo "\nRedirect Location: " . $response->headers->get('Location') . "\n";
    echo "\nThis is likely due to:\n";
    echo "1. The 'guest' middleware detecting an authenticated session\n";
    echo "2. Or a component error\n";
}

echo "\n\nLet me check the logs:\n";
$logs = file_get_contents(__DIR__ . '/storage/logs/laravel.log');
$lines = array_reverse(explode("\n", $logs));
$count = 0;
foreach ($lines as $line) {
    if (strpos($line, '02:') !== false || strpos($line, 'forgot') !== false || strpos($line, 'password') !== false) {
        echo $line . "\n";
        $count++;
        if ($count >= 10) break;
    }
}
