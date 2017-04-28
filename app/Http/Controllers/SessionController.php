<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function accessSessionData(Request $request){
        if($request->session()->has('my_name')){
            echo $request->session()->get('my_name');
        } else {
            echo "'my_name' is not in the session";
        }
    }

    public function putSessionData(Request $request){
        $request->session()->put('my_name', 'Jacky Efendi');
        echo "Data has been put into the session";
    }

    public function deleteSessionData(Request $request){
        $request->session()->forget('my_name');
        echo "'my_name' has been deleted/forgotten from session";
    }
}
