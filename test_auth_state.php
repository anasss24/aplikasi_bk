<?php

// Load composer autoload
require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel application
$app = require_once __DIR__ . '/bootstrap/app.php';

// Create request context
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Make a fake request to login page to test the route
try {
    // Create a request WITHOUT any authentication
    $request = \Illuminate\Http\Request::create('/forgot-password', 'GET');
    
    // Check session and auth state
    echo "Request path: " . $request->path() . "\n";
    echo "Is AJAX: " . ($request->ajax() ? 'YES' : 'NO') . "\n";
    
    // Make the request through the kernel
    $response = $kernel->handle($request);
    
    $status = $response->getStatusCode();
    echo "Response status: $status\n";
    
    if ($status === 302) {
        $location = $response->headers->get('Location');
        echo "Redirects to: $location\n";
        
        // Now check if there's an issue with the RedirectIfAuthenticated middleware
        echo "\nThe issue: /forgot-password is in the 'guest' middleware group\n";
        echo "But the guest middleware is redirecting to /login\n";
        echo "This means Auth::check() is returning TRUE\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
