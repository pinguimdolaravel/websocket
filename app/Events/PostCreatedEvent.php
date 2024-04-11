<?php

declare(strict_types = 1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreatedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public ?string $message = null;

    public function __construct(
        public string $by,
    ) {
        $this->message = "A new post was created by {$this->by}.";
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('blog'),
            new PrivateChannel('app'),
        ];
    }
}
