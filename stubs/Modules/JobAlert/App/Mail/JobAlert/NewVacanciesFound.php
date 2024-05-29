<?php

namespace App\Mail\JobAlert;

use App\Models\JobAlert;
use App\Models\Label;
use App\Models\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewVacanciesFound extends Mailable
{
    use Queueable, SerializesModels;

    public Page $page;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public JobAlert $jobAlert,
        public Collection $vacancies,
    )
    {
        $this->page = Label::getModel('job-alert-overview');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nieuwe vacatures gevonden',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.job-alert.new-vacancies-found',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
