<?php

// Load composer autoload
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';

// Create request context
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Make a fake request to login page to test the route
try {
    $request = \Illuminate\Http\Request::create('/login', 'GET');
    $response = $kernel->handle($request);
    
    // Check if the response contains the password.request link
    $content = $response->getContent();
    
    if (strpos($content, 'forgot-password') !== false) {
        echo "✓ forgot-password URL found in login page\n";
    } else {
        echo "✗ forgot-password URL NOT found in login page\n";
    }
    
    if (strpos($content, 'password.request') !== false) {
        echo "✓ password.request route name found in login page\n";
    } else {
        echo "✗ password.request route name NOT found in login page\n";
    }
    
    // Try to access forgot-password directly
    $request2 = \Illuminate\Http\Request::create('/forgot-password', 'GET');
    $response2 = $kernel->handle($request2);
    
    $status = $response2->getStatusCode();
    echo "\nGET /forgot-password status: $status\n";
    
    if ($status === 200) {
        echo "✓ /forgot-password is accessible (200 OK)\n";
    } elseif ($status === 302 || $status === 301) {
        echo "✗ /forgot-password redirects to: " . $response2->headers->get('Location') . "\n";
    } else {
        echo "✗ /forgot-password returned status: $status\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
