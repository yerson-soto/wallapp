<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    //one to many
    public function comments() {
        return $this->hasMany(App\Comment);
    }

    //one to many
    public function likes() {
        return $this->hasMany(App\Like);
    }

    //one to many (inverse)
    public function user() {
        return $this->belongsTo(App\User);
    }

}
