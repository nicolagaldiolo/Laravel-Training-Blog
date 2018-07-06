<?php

namespace App\Jobs;

use App\User;
use App\Post;
use App\Mail\PostUpdateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPostUpdateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipient;
    public $modifier;
    public $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $recipient, User $modifier, Post $post)
    {
        $this->recipient = $recipient;
        $this->modifier = $modifier;
        $this->post = $post;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        echo 'dentro il job ' . date('H:i:s');


        Mail::to($this->recipient)->send(new PostUpdateEmail($this->recipient, $this->modifier, $this->post));
    }
}
