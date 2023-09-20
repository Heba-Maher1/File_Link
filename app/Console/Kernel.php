<?php

namespace App\Console;

use App\Jobs\SendNotificationToExpiredSubscriptions;
use App\Models\Subscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('model:prune' , [
            '--model' => Subscription::class,
        ])->dailyAt('03:00');

        $schedule->job(new SendNotificationToExpiredSubscriptions())
            ->dailyAt('09:04');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
