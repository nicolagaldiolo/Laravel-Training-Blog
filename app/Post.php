<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //protected $fillable = ['title', 'category_id', 'preview', 'body']; // definisco i campi che posso riempire
    protected $guarded = [];

    // NON SERVE FARE QUESTA COSA SE IMPLEMENTO UN OBSERVE
    /*public static function boot(){
        parent::boot(); // chiamo il metodo boot della classe padre (model) perchè sto sovrascrivendo il
        // metodo boot della classe ma ho necessità comunque di chiamare il metodo boot della classe padre

        // questo metodo viene automaticamente chiamato quando tento di cancellare un record
        static::deleting(function($post){
            // rimuovere associazioni tags
            $post->tags()->sync([]); // se gli passo un array vuoto spiano via tutto
            unlink(public_path($post->cover)); // elimino il file
        });

        static::updated(function($post){
            event(new PostWasUpdated($post));
        });

    }*/

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // appartiene a una Category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // ha 1 o + Tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // ha 1 o + Commenti
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    //accessors - getters
    //public function getTitleAttribute($title){
    //    return strtoupper($title);
    //}

    //accessors - setters
    // metodo che viene invocato prima di salvare il dato, in questo caso title
    public function setTitleAttribute($title){
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);
        //$this->attributes['user_id'] = auth()->id();
    }

    public function setCoverAttribute($cover){
        $this->attributes['cover'] = $cover->store('covers');
    }

    public function getCoverAttribute($cover){
        //return ($cover) ?? "images/cover.jpg";
        return ($cover) ? 'storage/'.$cover : "/images/cover.jpg";
    }
}
