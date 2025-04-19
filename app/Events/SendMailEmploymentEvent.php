<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMailEmploymentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $company ;
    public $content;

    public function __construct($company,$content)
    {
        $this->company = $company;
        $this->content = $content;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
