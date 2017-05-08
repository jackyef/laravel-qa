<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __contruct(){
        $this->middleware('AdminAuth');
    }
    public function addTags(Request $request){
        $tags = $request->tags;

        foreach($tags as $tag){
            //check if tag existed already
            $query = DB::select("SELECT * FROM tags WHERE tag = ?", [$tag]);
            if(sizeof($query) > 0){
                // tag exists already
                continue;
            } else {
                // tag doesn't exist yet, let's add it
                DB::insert("INSERT INTO tags (tag) VALUES (?)", [$tag]);
            }
        }
        $request->session()->flash('notification', TRUE);
        $request->session()->flash('notification_type', 'success');
        $request->session()->flash('notification_msg', 'Tags successfully added!');
        return redirect()->back();
    }
}
