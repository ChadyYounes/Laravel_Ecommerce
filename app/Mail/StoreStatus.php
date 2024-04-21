<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StoreStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct(bool $status)
    {
        $this->status = $status;
    }

   

    /**
     * Get the message content definition.
     */

/**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $statusText = $this->status ? 'activated' : 'deactivated';
        $subject = 'Your store has been ' . $statusText;
        
        return $this->subject($subject)
            ->view('admin.email-store-status');
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
