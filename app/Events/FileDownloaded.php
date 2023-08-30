<?php

namespace App\Events;

use App\Models\File;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileDownloaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $file;
    public $userAgent;
    public $ipAddress;
    public $country;

    public function __construct(File $file, $userAgent, $ipAddress, $country)
    {
        $this->file = $file;
        $this->userAgent = $userAgent;
        $this->ipAddress = $ipAddress;
        $this->country = $country;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
