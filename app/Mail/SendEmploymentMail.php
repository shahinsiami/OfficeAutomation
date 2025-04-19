<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmploymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $company ;
    public $content;
   
    public function __construct($company,$content)
    {
        $this->company = $company;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('استخدام')
            ->markdown('Email.employment');
    }
}
