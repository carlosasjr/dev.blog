<?php

namespace App\Listeners;

use App\Events\CommentAnswered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatusCommentAnswered
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentAnswered  $event
     * @return void
     */
    public function handle(CommentAnswered $event)
    {
        $comment = $event->comment();
        $comment->status = 'A';
        $comment->save();
    }
}
