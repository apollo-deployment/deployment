<?php

namespace App\Console;

use App\Console\Commands\Test;
use App\Console\Commands\VerificationExpire;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     */
    protected $commands = [
        VerificationExpire::class,
        Test::class
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:verifications')->twiceDaily();
    }

    /**
     * Register the Closure based commands for the application.
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

}
