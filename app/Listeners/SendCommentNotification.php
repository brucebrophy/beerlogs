<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Mail\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
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
     * @param  CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        \Mail::to($event->comment->commentable->user->email)
            ->send(new CommentNotification($event->comment));
    }
}
