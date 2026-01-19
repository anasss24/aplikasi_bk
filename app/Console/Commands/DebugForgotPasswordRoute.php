<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DebugForgotPasswordRoute extends Command
{
    protected $signature = 'debug:forgot-password-route';
    protected $description = 'Debug the forgot-password route access';

    public function handle()
    {
        // Simulate HTTP GET request to /forgot-password
        $this->info('Simulating GET /forgot-password...');
        
        // Check what RouteServiceProvider loads
        $routes = app('router')->getRoutes();
        
        $forgotPasswordRoute = null;
        foreach ($routes as $route) {
            if ($route->getName() === 'password.request') {
                $forgotPasswordRoute = $route;
                break;
            }
        }
        
        if ($forgotPasswordRoute) {
            $this->info('✓ Route found: password.request');
            $this->info('  URI: ' . $forgotPasswordRoute->uri());
            $this->info('  Methods: ' . implode(',', $forgotPasswordRoute->methods()));
            $this->info('  Controller: ' . $forgotPasswordRoute->getActionName());
            $this->info('  Middleware: ' . implode(', ', $forgotPasswordRoute->middleware()));
        } else {
            $this->error('✗ Route not found');
        }
    }
}
