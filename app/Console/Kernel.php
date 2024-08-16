<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Example: Schedule a command to run every day at midnight
        // $schedule->command('your:command')->daily();

        // Example: Schedule a task to run every hour
        // $schedule->command('your:command')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load commands from the Commands directory
        $this->load(__DIR__.'/Commands');

        // Register console routes
        require base_path('routes/console.php');
    }
}
