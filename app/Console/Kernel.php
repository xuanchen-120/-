<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('backup:clean --disable-notifications')->weekly()->at('01:00'); //每周1点执行 清理
        // $schedule->command('backup:run --disable-notifications')->weekly()->at('02:00'); //每周2点执行

        $schedule->command('backup:clean --disable-notifications')->dailyAt('10:00'); //每周1点执行 清理

        $schedule->command('backup:run --only-db --disable-notifications')->dailyAt('10:10'); //每周2点执行

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
