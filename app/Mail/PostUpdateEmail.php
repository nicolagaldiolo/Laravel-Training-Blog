<?php

namespace App\Mail;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $recipient;
    public $modifier;
    public $post;

    public function __construct(User $recipient, User $modifier, Post $post)
    {
        $this->recipient = $recipient;
        $this->modifier = $modifier;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Se non specifico nulla l'oggetto della mail viene preso da nome della classe PostUpdateEmail,
        // altrimenti lo posso specificare

        return $this->subject('An article has benn modified')->markdown('emails.posts.updated-email');
    }
}
