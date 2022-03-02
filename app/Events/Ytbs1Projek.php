<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Ytbs1Projek implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tegangan, $arus, $dy_aktif, $energi;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tegangan, $arus, $dy_aktif, $energi)
    {
        $this->tegangan = $tegangan;
        $this->arus = $arus;
        $this->dy_aktif = $dy_aktif;
        $this->energi = $energi;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('massage');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
