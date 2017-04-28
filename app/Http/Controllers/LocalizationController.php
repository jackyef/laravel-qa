<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale){
        //set app locale
        app()->setLocale($locale);

        //get the translated msg accordingly
        // lang.php file, 'msg' prop
        echo trans('lang.msg');
    }
}
