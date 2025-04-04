<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FailedJobNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $listenerName,
        public string $userEmail,
        public string $errorMessage
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Failed Job Notification',
        );
    }

    public function build(): self
    {
        return $this->subject('Error en Listener: ' . $this->listenerName)
            ->view('template.emails.failed_job_notification')
            ->with([
                'listenerName' => $this->listenerName,
                'userEmail' => $this->userEmail,
                'errorMessage' => $this->errorMessage,
            ]);
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
