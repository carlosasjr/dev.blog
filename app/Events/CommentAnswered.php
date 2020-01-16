<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentAnswered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $comment;
    private $reply;

    /**
     * CommentAnswered constructor.
     * @param Comment $comment
     * @param $reply
     */
    public function __construct(Comment $comment, $reply)
    {
        $this->comment = $comment;
        $this->reply = $reply;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function comment()
    {
        return $this->comment;
    }

    public function reply()
    {
        return $this->reply;
    }
}
