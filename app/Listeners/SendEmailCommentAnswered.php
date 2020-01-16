<?php

namespace App\Listeners;

use App\Events\CommentAnswered;
use App\Mail\SendMailCommentAnswered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailCommentAnswered
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

        Mail::send(new SendMailCommentAnswered($event->comment(), $event->reply()));
    }
}
