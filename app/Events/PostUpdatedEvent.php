<?php

declare(strict_types = 1);

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public ?string $message = null;

    public function __construct(
        public string $by,
        protected int $id,
    ) {
        $this->message = "A post #{$id} was updated by {$this->by}.";
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('blog'),
            new PrivateChannel('app'),
        ];
    }
}
