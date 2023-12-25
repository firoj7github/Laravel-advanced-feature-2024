<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The content data for the email.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $content
     */
    public function __construct($content)
    {
        $this->data = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome Hello Message')
                    ->view('email.welcome')
                    ->with(['data' => $this->data]); 
    }
}
