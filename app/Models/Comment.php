<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    // each comment is posted by one user
    public function user(){
        return $this->belongsTo('User');
    }
    // each comment is posted by one post
    public function post(){
        return $this->belongsTo('Post');
    }

    // each comment can have many votes from users
    // define our pivot table also
    public function votes() {
        return $this->belongsToMany('User', 'user_voted_comments', 'comment_id', 'user_id');
    }
}
