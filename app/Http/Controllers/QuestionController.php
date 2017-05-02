<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function newQuestionForm(Request $request){
        $data = [];
        if($request->has('question')){
            $data->question = $request->question;
        }

        return view('question.ask', $data);
    }
}
