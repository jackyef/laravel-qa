<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Model\User;
class ValidationController extends Controller
{
    public function showForm(){
        return view('login');
    }

    public function validateForm(Request $request){
        $this->validate($request, [
            'username' => 'required|max:8',
            'password' => 'required|same:password2',
            'email' => 'required|email',
        ]);

        $user = new User;

        $user->username = $request->username;
        $user->password = sha1($request->password);
        $user->email = $request->email;

        $user->save();

        return redirect()->action('MainController@index');

    }
}
