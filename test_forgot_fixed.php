<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Test accessing /forgot-password
$request = \Illuminate\Http\Request::create('/forgot-password', 'GET');
$response = $kernel->handle($request);

$status = $response->getStatusCode();
echo "Status: $status\n";

if ($status === 200) {
    echo "✓ /forgot-password is now accessible (200 OK)\n";
    $content = $response->getContent();
    if (strpos($content, 'Lupa password') !== false) {
        echo "✓ Page contains 'Lupa password' text\n";
    } else {
        echo "✗ Page doesn't contain 'Lupa password' text\n";
    }
} else if ($status === 302) {
    echo "✗ Still redirecting to: " . $response->headers->get('Location') . "\n";
} else {
    echo "Status: $status\n";
}
