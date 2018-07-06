<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    public function scopeCompleted($query){
        return $query->where('completed', 1);
    }

    public function scopeUncompleted($query){
        return $query->where('completed', 0);
    }
}
