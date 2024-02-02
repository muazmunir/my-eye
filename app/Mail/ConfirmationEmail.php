<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userName;
    /**
     * Create a new message instance.
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    public function build()
    {
        return $this->subject('Account Confirmation')
                    ->markdown('emails.confirmation')
                    ->with(['userName' => $this->userName]);
    }
}
