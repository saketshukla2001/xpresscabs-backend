<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\ChangeDriversToTrips;
use App\Console\Commands\OfflineUnAvailableDrivers;
use App\Console\Commands\NotifyDriverDocumentExpiry;
use App\Console\Commands\AssignDriversForScheduledRides;
use App\Console\Commands\AssignDriversForRegularRides;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ClearDemoDatabase;
use App\Console\Commands\ClearRequestTable;
use App\Console\Commands\ClearOtp;
use App\Console\Commands\CancelRequests;



class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ChangeDriversToTrips::class,
        NotifyDriverDocumentExpiry::class,
        AssignDriversForScheduledRides::class,
        OfflineUnAvailableDrivers::class,
        AssignDriversForRegularRides::class,
        ClearDemoDatabase::class,
        ClearRequestTable::class,
        ClearOtp::class,
        CancelRequests::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         // File cache keeps the overlap lock across processes. The default
         // cache driver for this app is array, which does not.
         $schedule->useCache('file');

         $schedule->command('drivers:totrip')
                 ->everyMinute()
                 ->withoutOverlapping();
         $schedule->command('assign_drivers:for_regular_rides')
                 ->everyMinute()
                 ->withoutOverlapping();
         $schedule->command('assign_drivers:for_schedule_rides')
                 ->everyFiveMinutes()
                 ->withoutOverlapping();
        // Drivers must stay on duty; do not auto-offline them.
        // $schedule->command('offline:drivers')
        //          ->everyFiveMinutes();
         $schedule->command('notify:document:expires')
                 ->daily();
         $schedule->command('clear:otp')
                 ->everyFiveMinutes();
        // $schedule->command('clear:database')
        //          ->daily();
         $schedule->command('cancel:request')
                 ->everyMinute()
                 ->withoutOverlapping();
         $schedule->command('queue:work database --stop-when-empty --max-time=50 --tries=3')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->runInBackground();
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
