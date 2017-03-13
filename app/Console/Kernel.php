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
        //send event notification daily 3 days before the holiday
        $schedule->call(function () {
            $future_date = date('Y-m-d',strtotime(date('Y-m-d',time()).'+3 days'));
            $current_date = date('Y-m-d',time());
            //get all the events
            $rows = DB::table('holiday')
            ->where('start_date','<=',$future_date)
            ->where('start_date','>=',$current_date)
            ->get();

            if(!empty($rows)){
                $subscribers = DB::table('holiday_subscriber')
                ->where('daily_preference','=','1')
                ->where('active','=','1')
                ->get();
                foreach($subscribers as $subscriber){
                    $data = compact('subscriber','rows');
                    Mail::send('emails.daily-notification', $data, function($message) use ($subscriber) {
                        $message->to($subscriber->email_id);
                        $message->subject('Indian Holiday : Daily notification');
                    });
                }
            }
        })->dailyAt('10:00');

        $schedule->call(function () {
            $future_date = date('Y-m-d',strtotime(date('Y-m-d',time()).'+7 days'));
            $current_date = date('Y-m-d',time());
            //get all the events
            $rows = DB::table('holiday')
            ->where('start_date','<=',$future_date)
            ->where('start_date','>=',$current_date)
            ->get();

            if(!empty($rows)){
                $subscribers = DB::table('holiday_subscriber')
                ->where('weekly_preference','=','1')
                ->where('active','=','1')
                ->get();
                foreach($subscribers as $subscriber){
                    $data = compact('subscriber','rows');
                    Mail::send('emails.daily-notification', $data, function($message) use ($subscriber) {
                        $message->to($subscriber->email_id);
                        $message->subject('Indian Holiday : Weekly notification');
                    });
                }
            }
        })->cron('0 10 * * 5');

        $schedule->call(function () {
            $future_date = date('Y-m-d',strtotime(date('Y-m-d',time()).'+28 days'));
            $current_date = date('Y-m-d',time());
            //get all the events
            $rows = DB::table('holiday')
            ->where('start_date','<=',$future_date)
            ->where('start_date','>=',$current_date)
            ->get();

            if(!empty($rows)){
                $subscribers = DB::table('holiday_subscriber')
                ->where('monthly_preference','=','1')
                ->where('active','=','1')
                ->get();
                foreach($subscribers as $subscriber){
                    $data = compact('subscriber','rows');
                    Mail::send('emails.daily-notification', $data, function($message) use ($subscriber) {
                        $message->to($subscriber->email_id);
                        $message->subject('Indian Holiday : Monlty notification');
                    });
                }
            }
        })->cron('0 10 28 * *');
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
