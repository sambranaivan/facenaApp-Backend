<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $demo;
    public $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($demo,$mail)
    {
        $this->demo = $demo;///registros
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sender@example.com')
                    ->view('mails.demo')
                    ->subject($this->mail->subject);
                    // ->text('mails.demo_plain');
    }
}
