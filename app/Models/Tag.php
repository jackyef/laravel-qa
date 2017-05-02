<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // each question can have many tags
    // define our pivot table also
    public function tags() {
        return $this->belongsToMany('Question', 'question_has_tags', 'tag_id', 'question_id');
    }
}
