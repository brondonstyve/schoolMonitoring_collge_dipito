<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessageCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $email;
    public $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nom,$email,$text)
    {
        $this->nom=$nom;
        $this->email=$email;
        $this->text=$text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.messages.create');
    }
}
