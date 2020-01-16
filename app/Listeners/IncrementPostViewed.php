<?php

namespace App\Listeners;

use App\Events\PostViewed;
use App\Models\PostView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPostViewed
{

    /**
     * @return int
     */
    protected function userLogged()
    {
       return (auth()->check()) ? auth()->user()->id : 1;
    }


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
     * @param PostViewed $event
     */
    public function handle(PostViewed $event)
    {
        $postView = new PostView();

        $postView->user_id = $this->userLogged();
        $postView->post_id = $event->post()->id;
        $postView->save();
    }



}
