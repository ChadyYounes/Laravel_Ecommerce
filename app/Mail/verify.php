<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class verify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The verification URL.
     *
     * @var string
     */
    public $verificationUrl;
    public $user;
    /**
     * Create a new message instance.
     *
     * @param string $verificationUrl
     * @return void
     */
    
    

    public function __construct($verificationUrl, $user)
    {
        $this->verificationUrl = $verificationUrl;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Verify Your Email')
            ->view('auth.verify');
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
