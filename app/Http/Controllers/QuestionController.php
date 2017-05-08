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
        $request->session()->flash('notification_msg', 'Question asked! Check again later to see if people have given answers to your question!');

        return redirect()->action('MainController@question', ['question' => $question_id]);
    }

    public function votePost($post_id, Request $request){
        DB::beginTransaction();

        try {
            DB::insert("
                INSERT INTO user_voted_posts 
                (post_id, user_id)
                VALUES
                (?, ?)
            ", [$post_id, $request->session()->get('id')]);

            DB::update("
                UPDATE posts
                SET votes = votes + 1
                WHERE id = ?
            ", [$post_id]);
            DB::commit();
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'success');
            $request->session()->flash('notification_msg', 'Your vote has been counted! Thank you for your input for the community!');

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'danger');
            $request->session()->flash('notification_msg', 'Uh oh, something went wrong while trying to register your vote.');
        }

        return redirect()->to(url()->previous().'#'. $post_id);
    }

    public function unvotePost($post_id, Request $request){
        DB::beginTransaction();

        try {
            DB::delete("
                DELETE FROM user_voted_posts 
                WHERE 
                post_id = ? AND
                user_id = ?
            ", [$post_id, $request->session()->get('id')]);

            DB::update("
                UPDATE posts
                SET votes = votes - 1
                WHERE id = ?
            ", [$post_id]);
            DB::commit();
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'success');
            $request->session()->flash('notification_msg', 'Your vote has been canceled!');

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'danger');
            $request->session()->flash('notification_msg', 'Uh oh, something went wrong while trying to unregister your vote.');
        }

        return redirect()->to(url()->previous().'#'. $post_id);
    }

    public function answer(Request $request){

        try {
            $post = new Post();
            $post->post_content = Input::get('post_content');
            $post->user_id = Session::get('id');
            $post->votes = 0;
            $post->question_id = Input::get('question_id');
            $post->save();

            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'success');
            $request->session()->flash('notification_msg', 'Your answer is posted! Thank you for your input for the community!');

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'danger');
            $request->session()->flash('notification_msg', 'Uh oh, something went wrong while trying to take your answer.');
        }

        return redirect()->to(url()->previous());
    }

    public function acceptAnswer(Request $request){
        try {

            $question = Question::find(Input::get('question_id'));
            $question->accepted_answer_id = Input::get('post_id');
            $question->save();

            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'success');
            $request->session()->flash('notification_msg', 'You have accepted an answer! Thank you for your input for the community!');

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'danger');
            $request->session()->flash('notification_msg', 'Uh oh, something went wrong while trying to accept an answer.');
        }

        return redirect()->to(url()->previous(). '#' . Input::get('post_id'));
    }
}
