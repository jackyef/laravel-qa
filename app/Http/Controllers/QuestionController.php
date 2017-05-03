<?php

namespace app\Http\Controllers;

use app\Post;
use app\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function __construct(){
        $this->middleware('MyAuth');
    }

    public function newQuestionForm(Request $request){
        $data = [];
        if($request->has('question')){
            $data['question'] = $request->question;
        }
        $tags = DB::select("
                    SELECT * FROM tags
                    ORDER BY tag
            ");
        $data['allowed_tags'] = $tags;

        return view('questions.ask', $data);
    }

    public function newQuestionSubmit(Request $request){
        $data = [];
        if($request->has('question')){
            $data['question'] = $request->question;
        } else {
            $data['question'] = '';
        }
        $question_title = $request->question_title;
        DB::beginTransaction();

            // create a new question
            $question = new Question();
            $question->question_title = $request->question_title;
            $question->user_id = Session::get('id');
            $question->accepted_answer_id = 0;
            $question->save();
            $question_id = DB::getPdo()->lastInsertId();

            // create the first post
            $post = new Post();
            $post->post_content = $request->first_post;
            $post->votes = 0;
            $post->user_id = Session::get('id');
            $post->question_id = $question_id;
            $post->save();

            // associate the related tags
            $tags = $request->input('tags');
            foreach($tags as $tag){
                DB::insert("
                    INSERT INTO question_has_tags 
                    (tag_id, question_id) 
                    VALUES (?, ?)
                ", [$tag, $question_id]);
            }

        DB::commit();


        $request->session()->flash('notification', TRUE);
        $request->session()->flash('notification_type', 'success');
        $request->session()->flash('notification_msg', 'Question asked! You will be notified when people give answers to your question!');

        // TODO: redirect to question detail page when it's done
        return redirect()->action('MainController@index');
    }
}
