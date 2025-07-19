<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearPasswordResetThrottle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:clear-reset-throttle {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear password reset throttle for user(s)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            // Clear specific user
            $deleted = DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            if ($deleted > 0) {
                $this->info("Password reset throttle cleared for {$email}");
            } else {
                $this->warn("No throttle found for {$email}");
            }
        } else {
            // Clear all
            $deleted = DB::table('password_reset_tokens')->delete();
            $this->info("All password reset tokens cleared ({$deleted} tokens)");
        }

        return 0;
    }
}
