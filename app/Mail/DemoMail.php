<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->subject('Mail from' . '  ' . $this->mailData['email'])
    //         ->view('portal.admin.emails.demoMail');
    // }

    public function build()
    {
        return $this->from($this->mailData['email'], 'llllllllllllll')
            ->subject($this->mailData['subject'])
            ->replyTo($this->mailData['email'])
            ->view('portal.admin.emails.demoMail', ['mailData' => $this->mailData]);
    }

}
