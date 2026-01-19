<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TestHttpOtpFlow extends Command
{
    protected $signature = 'test:http-otp-flow';
    protected $description = 'Test OTP flow via HTTP requests';

    public function handle()
    {
        $this->info("========== HTTP OTP FLOW TEST ==========\n");
        
        $baseUrl = 'http://localhost:8000';
        $email = 'test@example.com';
        
        // Step 1: Get CSRF token from forgot-password page
        $this->info("STEP 1: GET /forgot-password");
        try {
            $response = $this->makeHttpRequest("GET", "$baseUrl/forgot-password");
            
            if ($response['status'] === 200) {
                $this->info("  ✓ Status: 200 OK");
                
                // Extract CSRF token
                if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $response['body'], $matches)) {
                    $csrfToken = $matches[1];
                    $this->info("  ✓ CSRF Token found: " . substr($csrfToken, 0, 10) . "...");
                } else {
                    $this->error("  ✗ CSRF Token not found in HTML");
                    return;
                }
            } else {
                $this->error("  ✗ Status: {$response['status']}");
                return;
            }
        } catch (\Exception $e) {
            $this->error("  ✗ Request failed: " . $e->getMessage());
            return;
        }
        
        // Step 2: POST to forgot-password
        $this->info("\nSTEP 2: POST /forgot-password");
        try {
            $postData = http_build_query([
                '_token' => $csrfToken,
                'email' => $email,
            ]);
            
            $response = $this->makeHttpRequest("POST", "$baseUrl/forgot-password", $postData);
            
            $this->info("  Status: {$response['status']}");
            
            if ($response['status'] === 302) {
                $location = $response['headers']['Location'] ?? 'NOT FOUND';
                $this->info("  ✓ Redirect to: {$location}");
                
                // Check for session cookie
                $cookies = $response['headers']['Set-Cookie'] ?? [];
                $this->info("  ✓ Cookies set: " . (count($cookies) > 0 ? 'YES' : 'NO'));
                
            } else if ($response['status'] === 200) {
                $this->warn("  ⚠ Got 200 instead of redirect (might be error page)");
                $this->line("  Body: " . substr($response['body'], 0, 200));
            } else {
                $this->error("  ✗ Unexpected status: {$response['status']}");
            }
        } catch (\Exception $e) {
            $this->error("  ✗ Request failed: " . $e->getMessage());
        }
        
        $this->info("\n========== TEST COMPLETE ==========");
    }
    
    protected function makeHttpRequest($method, $url, $data = null)
    {
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        
        if ($method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($response === false) {
            throw new \Exception(curl_error($ch));
        }
        
        curl_close($ch);
        
        // Parse headers and body
        $parts = explode("\r\n\r\n", $response, 2);
        $headerLines = explode("\r\n", $parts[0]);
        $body = $parts[1] ?? '';
        
        $headers = [];
        foreach ($headerLines as $line) {
            if (strpos($line, ': ') !== false) {
                list($key, $value) = explode(': ', $line, 2);
                if ($key === 'Set-Cookie') {
                    if (!isset($headers['Set-Cookie'])) {
                        $headers['Set-Cookie'] = [];
                    }
                    $headers['Set-Cookie'][] = $value;
                } else {
                    $headers[$key] = $value;
                }
            }
        }
        
        return [
            'status' => $httpCode,
            'headers' => $headers,
            'body' => $body,
        ];
    }
}
