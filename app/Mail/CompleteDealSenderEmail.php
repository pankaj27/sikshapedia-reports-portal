<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompleteDealSenderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $attachment;
    public $message ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attachment,$message)
    {
        //
        $this->attachment = $attachment;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $msg = $this->message;
        return $this->subject('sikshapedia Bill /Invoice ')->view('email-templates.complete-deal-sender',compact('msg'))->attach($this->attachment);
    }
}
