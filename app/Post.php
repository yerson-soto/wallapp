<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    //one to many
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    //one to many
    public function likes() {
        return $this->hasMany(Like::class);
    }

    //one to many (inverse)
    public function user() {
        return $this->belongsTo(User::class);
    }

}
