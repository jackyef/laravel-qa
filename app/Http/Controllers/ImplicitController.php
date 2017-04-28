<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class ImplicitController extends Controller
{

	public function index(\MyClass $myClass){
		//MyClass is defined in the routes\web.php file
		// the controller can access it
		dd($myClass);
		dd($this);
	}
    /**
   * Responds to requests to GET /test
   */
   public function getIndex(){
      echo 'index method';
   }
   
   /**
   * Responds to requests to GET /test/show/1
   */
   public function getShow($id){
      echo 'show method';
   }
   
   /**
   * Responds to requests to GET /test/admin-profile
   */
   public function getAdminProfile(){
      echo 'admin profile method';
   }
   
   /**
   * Responds to requests to POST /test/profile
   */
   public function postProfile(){
      echo 'profile method';
   }
}
