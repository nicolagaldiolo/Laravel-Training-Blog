<?php

namespace App\Listeners;

use App\User;
use App\Jobs\SendPostUpdateEmail;
use App\Events\PostWasUpdated;


class PostWasUpdatedListener
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
     * @param  PostWasUpdated  $event
     * @return void
     */
    public function handle(PostWasUpdated $event)
    {
        //logger($event->post->title . ' was updated');

        //trova autore post
        $event->post->load('user');
        //logger($event->post->user->email);

        $admin = User::where('role', 'admin')->first();

        if( auth()->id() == $event->post->user_id){
            $recipient = $admin;
            $modifier = $event->post->user;
        }else{
            $recipient = $event->post->user;
            $modifier = $admin;
        }

        // Non volgio gestire il tutto in asincrono ma faccio un job
        SendPostUpdateEmail::dispatch($recipient, $modifier, $event->post);

        //invia mail



    }
}
