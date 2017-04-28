<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudViewController extends Controller
{
    public function index(){
        $students = DB::select("SELECT * FROM student");
        return view('stud_view', ['students' => $students]);
    }
}
