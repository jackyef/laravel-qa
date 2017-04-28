<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function index(Request $request, Response $response){

    }

    public function setCookie(Request $request){
        $minutes = 1;
        $name = "myCookie";
        $value = "value of my cookie";
        $response = new Response("Cookie \"{$name}\" set with the value \"{$value}\"!");
        $response->withCookie(cookie($name, $value, $minutes));
        return $response;
    }

    public function getCookie(Request $request){
        $value = $request->cookie('myCookie');
        echo $value;
    }
}
