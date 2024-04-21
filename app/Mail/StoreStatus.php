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
    public $storeName;

    /**
     * Create a new message instance.
     *
     * @param bool $status
     * @param string $storeName
     */
    public function __construct(bool $status, string $storeName)
    {
        $this->status = $status;
        $this->storeName = $storeName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $statusText = $this->status ? 'activated' : 'deactivated';
        $subject = 'Your store "' . $this->storeName . '" has been ' . $statusText;
        
        return $this->subject($subject)
            ->view('admin.email-store-status');
    }
}
