<?php

use App\Console\Commands\SendJobAlerts;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SendJobAlerts::class)->dailyAt('19:00');
