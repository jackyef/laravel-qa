<?php

namespace app\Http\Controllers;

use app\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function index(){
        $data['questions'] = Question::all();

        foreach ($data['questions'] as $question){
            $tags = DB::select("
                    SELECT 
                      t.tag 
                    FROM 
                      tags t, question_has_tags qht 
                    WHERE
                      qht.question_id = ? AND
                      qht.tag_id = t.id
                ", [$question['id']]);

            $result_tags = [];
            foreach($tags as $tag){
                array_push($result_tags, $tag->tag);
            }
            $question['tags'] = $result_tags;

            $first_post = DB::select("
                    SELECT
                      p.votes, p.user_id, u.username
                    FROM
                      posts p, users u, questions q
                    WHERE
                      q.id = ? AND 
                      p.question_id = q.id AND 
                      u.id = p.user_id
                    ORDER BY
                      p.id ASC
                    LIMIT 1
                ", [$question['id']]);

            $question['votes'] = $first_post[0]->votes;
            $question['asker'] = $first_post[0]->username;

            $answers_count = DB::select("
                    SELECT
                      p.*
                    FROM
                      posts p
                    WHERE
                      p.question_id = ?
                    ORDER BY
                      p.id ASC
                ", [$question['id']]);

            $question['answers'] = sizeof($answers_count)-1;



        }

        return view('index', $data);
    }
}
