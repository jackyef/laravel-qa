<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class UriController extends Controller
{
    public function index(Request $request){
		$path = $request->path();
		echo 'Path Method: '. $path;
		
		$pattern = $request->is('foo/*');
		echo '<br />';
		echo 'Is method: '. $pattern;
		
		$url = $request->url();
		echo '<br />';
		echo 'Url method: '. $url;
	}
}
