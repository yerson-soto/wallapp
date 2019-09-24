<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //one to many (inverse)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //one to many (inverse)
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
