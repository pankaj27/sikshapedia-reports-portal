<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SignedMouConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $attachment;
    /**
     * Create a new message instance.
     */
    public function __construct($attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
       
        return $this->subject('MOU Uploaded Successfully ! by sikshapedia Global LLP')->view('email-templates.signed-mou-confirmation')->attach($this->attachment);
    }
}
