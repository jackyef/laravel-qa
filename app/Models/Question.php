<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    // each question has many posts
    public function posts() {
        return $this->hasMany('Post');
    }

    // each question is posted by one user
    public function user(){
        return $this->belongsTo('User');
    }
    // each question can have one accepted answer
//    public function accepted_answer(){
//        return $this->hasOne('Post');
//    }

    // each question can have many tags
    // define our pivot table also
    public function tags() {
        return $this->belongsToMany('Tag', 'question_has_tags', 'question_id', 'tag_id');
    }


}
