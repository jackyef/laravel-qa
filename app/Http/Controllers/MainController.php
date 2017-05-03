<?php

namespace app\Http\Controllers;

use app\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    public function index(Request $request){
        $data['filter'] = $request->filter ?: 'recent';
        $filter = $data['filter'];
        $data['page'] = $request->page ?: 1;
        $page = $data['page'];
        $data['limit'] = $request->limit ?: 10;

        if($data['filter'] == 'recent'){
            $questions = Question::orderBy('created_at', 'desc')
                            ->orderBy('id', 'desc');
        } else if($data['filter'] == 'trending'){
            // implement some kind of algorithm to fetch based on trending questions
        } else if($data['filter'] == 'open'){
            $questions = Question::where('accepted_answer_id', 0)
                ->orderBy('created_at', 'desc');
        } else if($data['filter'] == 'answered'){
            $questions = Question::where('accepted_answer_id', '<>', 0)
                ->orderBy('created_at', 'desc');
        } else {
            // fallback if user entered random gibberish in the url
            $questions = Question::orderBy('created_at', 'desc')
                ->orderBy('id', 'desc');;
        }
        $questions = $questions->paginate($data['limit']);
        $questions->setPath(url("/?filter=$filter"));

        $data['questions'] = $questions;

//        $data['questions'] = Question::limit(5)->offset(0)->get();
//        $data['questions'] = $questions->results;
//        $data['questions_links'] = $questions->links();

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

//        // get 10 most popular tags
//        $tags = DB::select("
//                SELECT qht.tag_id as 'tag_id', t.tag as 'tag', COUNT(qht.tag_id) as 'count'
//                FROM question_has_tags qht, tags t
//                WHERE
//                  qht.tag_id = t.id
//                GROUP BY
//                  qht.tag_id, t.tag
//                ORDER BY
//                  count DESC
//            ");
//        $data['popular_tags'] = $tags;

        return view('index', $data);
    }

    public function seed(){
        while(true){
            $question_id = random_int(1,23);
            $tag_id = random_int(1,5);
            DB::insert("
                INSERT INTO question_has_tags (question_id, tag_id)
                VALUES (?, ?)
            ", [$question_id, $tag_id]);
        }
    }
}
