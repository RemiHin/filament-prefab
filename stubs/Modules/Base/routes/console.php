<?php

use App\Console\Commands\PurgeSentEmails;

Schedule::command(PurgeSentEmails::class)->dailyAt('01:35');
