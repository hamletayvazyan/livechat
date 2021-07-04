<?php

namespace App\Events;

use App\Http\Resources\ChatMessageResource;
use App\MessageNew;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	public $message;
	public $chatId;
	private $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MessageNew $message, $userId, $chatId)
    {
	    $this->message = (new ChatMessageResource($message, $userId));
	    $this->userId = $userId;
	    $this->chatId = $chatId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
	    return ['chat.'.$this->chatId];
//	    return new Channel('chat.'.$this->userId);
    }
}
