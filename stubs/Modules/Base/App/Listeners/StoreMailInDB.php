<?php

declare(strict_types=1);

namespace App\Listeners;

use DOMDocument;
use App\Models\MailLog;
use Illuminate\Support\Arr;
use Illuminate\Mail\Message;
use Symfony\Component\Mime\Email;
use Illuminate\Mail\Events\MessageSending;;

class StoreMailInDB
{
    public function handle(MessageSending $event): void
    {
        if (! config('mail.log_mails', true)) {
            return;
        }

        if (! $event->message instanceof Email) {
            return;
        }

        $messageId = $event->message->generateMessageId();
        // MessageId is changed after sending the actual message...
        $event->message->getHeaders()->addIdHeader('Alternate-Message-ID', $messageId);

        MailLog::message($event->data, $this->getData($event->data));
    }

    protected function getData(array $data): array
    {
        $message = Arr::get($data, 'message');
        $additionalData = Arr::get($data, 'additionalData', []);

        return $additionalData + [
            'from_address' => $this->getFromAddress($message),
            'from_name' => $this->getFromName($message),
            'to_address' => $this->getToAddress($message),
            'to_name' => $this->getToName($message),
            'subject' => $this->getSubject($message),
            'body' => $this->getStrippedBody($message),
        ];
    }

    protected function getFromAddress(Message $message): ?string
    {
        if ($message->getFrom() && count($message->getFrom()) > 0) {
            foreach ($message->getFrom() as $from) {
                return $from->getAddress();
            }
        }

        return null;
    }

    protected function getFromName(Message $message): ?string
    {
        if ($message->getFrom() && count($message->getFrom()) > 0) {
            foreach ($message->getFrom() as $from) {
                return $from->getName();
            }
        }

        return null;
    }

    protected function getToAddress(Message $message): ?string
    {
        if ($message->getTo() && count($message->getTo()) > 0) {
            foreach ($message->getTo() as $to) {
                return $to->getAddress();
            }
        }

        return null;
    }

    protected function getToName(Message $message): ?string
    {
        if ($message->getTo() && count($message->getTo()) > 0) {
            foreach ($message->getTo() as $to) {
                return $to->getName();
            }
        }

        return null;
    }

    protected function getSubject(Message $message): ?string
    {
        return optional($message)->getSubject();
    }

    protected function getBody(Message $message): ?string
    {
        return $message->getBody()->toString();
    }

    protected function getStrippedBody(Message $message): ?string
    {
        $body = $this->getBody($message);

        if (! $body) {
            return null;
        }

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadHTML($body);
        libxml_use_internal_errors(false);

        $styles = $dom->getElementsByTagName('style');
        for ($i = $styles->length; --$i >= 0;) {
            $node = $styles->item($i);
            $node->parentNode->removeChild($node);
        }

        $scripts = $dom->getElementsByTagName('script');
        for ($i = $scripts->length; --$i >= 0;) {
            $node = $scripts->item($i);
            $node->parentNode->removeChild($node);
        }

        $bodyTag = $dom->getElementsByTagName('body')->item(0);

        $html = $dom->saveHTML($bodyTag);
        if (empty($html)) {
            $html = $body;
        }

        $strip = strip_tags($html);
        $minify = trim(str_replace(["\n", "\r"], ' ', $strip));

        // Remove whitespace
        return preg_replace('/\s+/', ' ', $minify);
    }

    protected function getAssociations(array $data): ?array
    {
        return Arr::get($data, 'associations', []);
    }
}
