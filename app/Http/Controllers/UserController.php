<?php

namespace app\Http\Controllers;

use app\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function __construct(){

	}

	public function validateSignup(Request $request){
        $this->validate($request, [
            'username' => 'required|min:5|alpha_dash|unique:users',
            'password' => 'required|min:8|same:password2',
            'email' => 'required|email|unique:users',
        ]);

        $user = new User();

        $user->username = $request->username;
        $user->password = sha1($request->password);
        $user->email = $request->email;

        $user->save();

        $request->session()->flash('notification', TRUE);
        $request->session()->flash('notification_type', 'info');
        $request->session()->flash('notification_msg', 'Successfully signed up! Now you can log in!');

        return redirect()->back();
    }

    public function authLogin(Request $request){
	    $users = DB::select('SELECT * FROM users WHERE username=? AND password=?', [$request->username, sha1($request->password)]);
	    if(count($users) === 1){
	        $request->session()->regenerateToken();
	        $request->session()->put('username', $users[0]->username);
	        $request->session()->put('email', $users[0]->email);
	        $request->session()->put('id', $users[0]->id);
        } else {
            $request->session()->flash('notification', TRUE);
            $request->session()->flash('notification_type', 'danger');
            $request->session()->flash('notification_msg', 'Invalid username/password');
        }

        return redirect()->back();
    }
    public function logout(Request $request){
        $request->session()->flush();

        return redirect()->back();
    }
    public function showPath(Request $request){
		$uri = $request->path();
		echo '<br> URI: '. $uri;

		$url = $request->url();
		echo '<br>';
		echo 'URL: '. $url;

		$method = $request->method();
		echo '<br>';
		echo 'Method: '. $method;

	}
}
