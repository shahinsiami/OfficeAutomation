<?php

namespace App\Listeners;

use App\Events\SendMailEmploymentEvent;
use App\Mail\SendEmploymentMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailEmploymentListener
{
 
    public function __construct()
    {
        //
    }

    public function handle(SendMailEmploymentEvent $event)
    {
        Mail::to($event->company)->send(new SendEmploymentMail($event->company,$event->content));
    }
}
