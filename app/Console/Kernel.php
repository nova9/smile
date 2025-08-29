<?php

use Illuminate\Console\Scheduling\Schedule;

class Kernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('event:send-reminders')->daily();
    }
}