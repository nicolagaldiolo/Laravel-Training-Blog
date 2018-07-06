<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // ha molti post
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
