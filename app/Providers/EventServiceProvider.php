<?php

namespace App\Providers;

use App\Events\CommentAnswered;
use App\Events\PostViewed;
use App\Listeners\ChangeStatusCommentAnswered;
use App\Listeners\IncrementPostViewed;
use App\Listeners\SendEmailCommentAnswered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        PostViewed::class => [
            IncrementPostViewed::class,
        ],

        CommentAnswered::class => [
            SendEmailCommentAnswered::class,
            ChangeStatusCommentAnswered::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
