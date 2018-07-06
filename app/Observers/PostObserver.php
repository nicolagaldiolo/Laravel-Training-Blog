<?php
/**
 * Created by PhpStorm.
 * User: chloe
 * Date: 28/06/18
 * Time: 16:30
 */

namespace App\Observers;
use App\Events\PostWasUpdated;
use App\Post;

class PostObserver
{
    public function deleting(Post $post){
        // questo metodo viene automaticamente chiamato quando tento di cancellare un record

        // rimuovere associazioni tags
        $post->tags()->sync([]); // se gli passo un array vuoto spiano via tutto
        unlink(public_path($post->cover)); // elimino il file
    }

    public function updated(Post $post){
        event(new PostWasUpdated($post));
    }
}