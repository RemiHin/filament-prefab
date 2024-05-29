<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\MailLog;
use Illuminate\Console\Command;

class PurgeSentEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mails:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge content of sent mails older than 4 weeks. This reduced the size of the record but prevents resending the e-mail';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        MailLog::query()
            ->where('purged', false)
            ->whereDate('created_at', '<', Carbon::today()->subWeeks(4))
            ->chunkById(50, function ($models) {
                foreach ($models as $mailLog) {
                    $mailLog->purge();
                }
            });
    }
}
