<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    // each post has many comments
    public function comments() {
        return $this->hasMany('Comment');
    }

    // each post is posted by one user
    public function user(){
        return $this->belongsTo('User');
    }
    // each post is belong in a question
    public function post(){
        return $this->belongsTo('Question');
    }

    // each post can have many votes from users
    // define our pivot table also
    public function votes() {
        return $this->belongsToMany('User', 'user_voted_posts', 'post_id', 'user_id');
    }
}
