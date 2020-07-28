<?php

namespace App\Console;

use App\Console\Commands\InstagramParser;
use App\Console\Commands\News\TelegramParser;
use App\Console\Commands\News\TwitterParser;
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
        InstagramParser::class,
        //NEWS PARSERS
        TelegramParser::class,
        TwitterParser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('instagram:parse')->hourly();
         $schedule->command('telegram:parse')->everyFiveMinutes();
         $schedule->command('twitter:parse')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
