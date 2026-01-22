<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->boot();

echo "Password Request URL: " . route('password.request') . "\n";
echo "Forgot Password URL: " . url('/forgot-password') . "\n";
