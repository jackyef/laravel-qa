<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudUpdateController extends Controller
{
    public function detail($id){
        $student = DB::select("SELECT * FROM student WHERE id=?", [$id]);
        echo "<a href=\"".url('/stud')."\">back to list</a>";
        echo "<br/>";
        echo "id: ". $student[0]->id;
        echo "<br/>";
        echo "name: ". $student[0]->name;
    }
    public function updateform($id){
        $student = DB::select("SELECT * FROM student WHERE id=?", [$id]);
        $data = ["id" => $id, "student" => $student[0]];
        return view('stud_update', $data);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $name = $request->input('stud_name');
        DB::update("UPDATE student SET name=? WHERE id=?", [$name, $id]);

        return redirect()->action("StudUpdateController@detail", ["id" => $id]);
    }

    public function delete($id){
        DB::delete("DELETE FROM student WHERE id=?", [$id]);
        return redirect()->action("StudViewController@index");
    }

    public function compare($id, $id2){
        $student = DB::select("SELECT * FROM student WHERE id=? OR id=?", [$id, $id2]);
        echo "<a href=\"".url('/stud')."\">back to list</a>";
        echo "<br/>";
        echo "id: ". $student[0]->id;
        echo "<br/>";
        echo "name: ". $student[0]->name;
        echo "<br/>";
        echo "<br/>";
        echo "compared to";
        echo "<br/>";
        echo "<br/>";
        echo "id: ". $student[1]->id;
        echo "<br/>";
        echo "name: ". $student[1]->name;
    }
}
