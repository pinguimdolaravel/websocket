<?php

declare(strict_types = 1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageCreatedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public ?string $message = null;

    public function __construct(
        public string $by
    ) {
        $this->message = "{$this->by} sent a new message";
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat'),
            new PrivateChannel('app'),
        ];
    }
}
