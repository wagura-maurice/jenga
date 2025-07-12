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
        // \Spatie\MigrateFresh\Commands\MigrateFresh::class,
        Commands\DrawLoanFine::class,
        Commands\Debug::class,
        Commands\GenerateLoanSchedule::class,
        Commands\RebaseGroupCashBooks::class,
        Commands\RebaseLoans::class,
        Commands\TransferStandingOrder::class,
        Commands\Seed::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('app:transfer-standing-order-via-lgf --db=jenga')->dailyAt('08:59:59');
        $schedule->command('app:draw-loan-fine --db=jenga')->dailyAt('08:59:59');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
