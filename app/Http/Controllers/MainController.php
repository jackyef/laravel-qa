<?php

namespace app\Http\Controllers;

use app\Post;
use app\Question;
use app\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        return view('index', $data);
    }

    public function question($question_id){
        $data = [];
        $data['question'] = DB::select("
            SELECT 
              q.*, 
              u.username as 'username', 
              u.id as 'user_id'
            FROM questions q, users u
            WHERE
              q.id = ? AND 
              q.user_id = u.id 
            ", [$question_id])[0];

        $tags = DB::select("
                    SELECT 
                      t.tag 
                    FROM 
                      tags t, question_has_tags qht 
                    WHERE
                      qht.question_id = ? AND
                      qht.tag_id = t.id
                ", [$question_id]);

        $result_tags = [];
        foreach($tags as $tag){
            array_push($result_tags, $tag->tag);
        }
        $data['question_tags'] = $result_tags;
        $data['first_post'] = DB::select("
            SELECT 
                p.*, 
                u.username as 'username', 
                u.id as 'user_id'
            FROM posts p, users u
            WHERE 
                p.question_id = ? AND 
                p.user_id = u.id 
            ORDER BY
                p.id ASC
            LIMIT 1
            ", [$question_id])[0];

        $data['last_post'] = DB::select("
            SELECT 
                p.*, 
                u.username as 'username', 
                u.id as 'user_id'
            FROM posts p, users u
            WHERE 
                p.question_id = ? AND 
                p.user_id = u.id 
            ORDER BY
                p.id DESC
            LIMIT 1
            ", [$question_id])[0];

        $data['answers'] = Post::where('question_id', $question_id)->offset(1)->paginate(10);
        foreach($data['answers'] as $answer){
            $user = DB::select("
                    SELECT
                      u.id as 'user_id', u.username as 'username'
                    FROM
                      posts p, users u
                    WHERE
                      p.id = ? AND 
                      u.id = p.user_id
                    ORDER BY
                      p.id ASC
                    LIMIT 1
                ", [$answer['id']]);

            $answer['user_id'] = $user[0]->user_id;
            $answer['username'] = $user[0]->username;
        }
        foreach($data['answers'] as $answer){
            $voted = DB::select("
                    SELECT *
                    FROM user_voted_posts 
                    WHERE 
                      user_id = ? AND 
                      post_id = ?
                    LIMIT 1
                ", [Session::get('id'), $answer['id']]);

            $voted = sizeof($voted) === 1;
            $answer['voted'] = $voted;
        }
        if($data['question']->accepted_answer_id !== 0){
            $data['accepted_answer'] = DB::select("
            SELECT 
                p.*, 
                u.username as 'username', 
                u.id as 'user_id'
            FROM posts p, users u
            WHERE 
                p.question_id = ? AND 
                p.user_id = u.id AND 
                p.id = ?
            ORDER BY
                p.id DESC
            LIMIT 1
            ", [$question_id, $data['question']->accepted_answer_id])[0];

            $voted = DB::select("
                    SELECT *
                    FROM user_voted_posts 
                    WHERE 
                      user_id = ? AND 
                      post_id = ?
                    LIMIT 1
                ", [Session::get('id'), $data['question']->accepted_answer_id]);

            $voted = sizeof($voted) === 1;
            $data['accepted_answer']->voted = $voted;
        }

        return view('questions.view', $data);
    }

    public function tag($tag, Request $request){
        $data['filter'] = $request->filter ?: 'recent';
        $filter = $data['filter'];
        $data['page'] = $request->page ?: 1;
        $page = $data['page'];
        $data['limit'] = $request->limit ?: 10;

        $data['tag'] = $tag;

        $tag_id = DB::select("
                SELECT * FROM tags WHERE tag = ?
            ", [$tag])[0]->id;

        $questions = DB::select("
                SELECT question_id FROM question_has_tags WHERE tag_id = ?
            ", [$tag_id]);

        $question_ids = array();
        foreach($questions as $question){
            array_push($question_ids, $question->question_id);
        }
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
        $questions = $questions->whereIn('id', $question_ids)->paginate($data['limit']);

        $questions->setPath(url("/$tag/?filter=$filter"));

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

        return view('tags.view', $data);
    }

    public function profile($username, Request $request){
        $data = [];
        $data['prof_username'] = $username;
        $user = User::whereUsername($username)->first();
        $data['user'] = $user;

        return view('profiles.view', $data);
    }

    public function seed(){
//        while(true){
//            $question_id = random_int(1,23);
//            $tag_id = random_int(1,5);
//            DB::insert("
//                INSERT INTO question_has_tags (question_id, tag_id)
//                VALUES (?, ?)
//            ", [$question_id, $tag_id]);
//        }

        $tags = ['life', 'love', 'software-engineering', 'software-development', 'web-development', 'food', 'culinary',
                'react-native', 'react', 'codeigniter3', 'codeigniter2', 'codeigniter', 'relationship', 'language',
                'social-convention', 'social-network', 'bootstrap', 'bootstrap-css', 'foundation-css', 'express.js',
                'mongodb', 'linux', 'windows', 'windows-7', 'windows-10', 'linux-ubuntu', 'writing', 'literature',
                'vacation', 'world-problem', 'ios', '.net', 'mac-OS', 'ASP', 'C', 'C++', 'C#', 'python', 'python3',
                'ruby', 'ruby-on-rails', 'django', 'flask', 'javascript', 'es6', 'es7', 'es5', 'wordpress',
                'drupal', 'node.js', 'angular', 'angular2'];

        foreach($tags as $tag){
            DB::insert("
                INSERT INTO tags (tag)
                VALUES (?)
            ", [$tag]);
        }
    }

}
