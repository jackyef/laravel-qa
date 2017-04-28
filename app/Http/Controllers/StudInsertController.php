<?php

namespace app\Http\Controllers;

use app\Events\StudentAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class StudInsertController extends Controller
{
    public function insertform(){
        return view('stud_create');
    }
    public function insert(Request $request){
        $name = $request->input('stud_name');
        DB::insert("INSERT INTO student (name) VALUES(?)", [$name]);
        echo "Record inserted successfully";
        echo "<br />";
        echo '<a href = "'.url('/stud').'">Click Here</a> to go back.';

        Event::fire(new StudentAdded($name));
    }
}
