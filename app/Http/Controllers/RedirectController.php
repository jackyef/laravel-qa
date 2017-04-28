<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    //
    public function index(){
        echo "You are redirected to the controller action: RedirectController@index";
    }
}
