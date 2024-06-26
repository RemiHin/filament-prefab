<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\MailLog;
use Illuminate\Mail\Events\MessageSent;

class MarkMailAsSent
{
    public function handle(MessageSent $event): void
    {
        if (! config('mail.log_mails', true)) {
            return;
        }

        // Alternate-Message-ID is not set when mail is not logged
        $originalMessageId = $event->message->getHeaders()->get('Alternate-Message-ID')?->getId();

        if (! $originalMessageId) {
            return;
        }

        MailLog::where('message_id', $originalMessageId)->update([
            'sent' => true,
        ]);
    }
}
