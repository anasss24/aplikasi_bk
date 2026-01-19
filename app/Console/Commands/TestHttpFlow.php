<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\HTTP;
use Illuminate\Support\Str;

class TestHttpFlow extends Command
{
    protected $signature = 'test:http-flow';
    protected $description = 'Test the HTTP flow of forgot password';

    public function handle()
    {
        $this->info('Testing HTTP flow for forgot password...');

        // Get the forgot password form first to get CSRF token
        try {
            $response = HTTP::get('http://localhost:8000/forgot-password');
            $this->info('✓ GET /forgot-password: ' . $response->status());

            // Extract CSRF token from HTML
            if (preg_match('/<input type="hidden" name="_token" value="([^"]+)"/', $response->body(), $matches)) {
                $token = $matches[1];
                $this->info('✓ CSRF Token extracted: ' . substr($token, 0, 10) . '...');

                // Now test POST
                $postResponse = HTTP::asForm()->post('http://localhost:8000/forgot-password', [
                    '_token' => $token,
                    'email' => 'test@example.com',
                ]);

                $this->info('✓ POST /forgot-password: ' . $postResponse->status());
                
                if ($postResponse->status() === 302) {
                    $this->info('✓ Redirect found!');
                    $location = $postResponse->header('Location');
                    $this->info('Redirects to: ' . $location);
                } else {
                    $this->warn('Expected 302 redirect, got: ' . $postResponse->status());
                    $this->line('Response body: ' . substr($postResponse->body(), 0, 500));
                }
            } else {
                $this->error('Could not extract CSRF token');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
