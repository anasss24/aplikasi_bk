<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckDatabase extends Command
{
    protected $signature = 'check:db';
    protected $description = 'Check database tables';

    public function handle()
    {
        // Check if sessions table exists
        if (Schema::hasTable('sessions')) {
            $this->info('✓ sessions table exists');
            $count = DB::table('sessions')->count();
            $this->info("  Sessions in table: $count");
        } else {
            $this->warn('✗ sessions table DOES NOT exist');
            $this->info('  Run: php artisan session:table && php artisan migrate');
        }

        // Check users table
        if (Schema::hasTable('users')) {
            $this->info('✓ users table exists');
            $count = DB::table('users')->count();
            $this->info("  Users in table: $count");
            
            // Check if test user exists
            $testUser = DB::table('users')->where('email', 'test@example.com')->first();
            if ($testUser) {
                $this->info('✓ Test user exists (test@example.com)');
            } else {
                $this->warn('✗ Test user does not exist');
            }
        } else {
            $this->error('✗ users table DOES NOT exist');
        }
    }
}
