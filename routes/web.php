<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', 'MainController@index');
Route::get('/login', function(){
    if(Session::has('username')) return redirect()->action('MainController@index');
    return view('login');
});
Route::post('/login', 'UserController@authLogin');
Route::post('/signup', 'UserController@validateSignup');
Route::get('/logout', 'UserController@logout');

Route::get('/profile/{username}', 'MainController@profile');
Route::post('/changepassword', 'UserController@changePassword');

Route::get('/ask', 'QuestionController@newQuestionForm');
Route::post('/ask', 'QuestionController@newQuestionSubmit');

Route::get('/question/{question}', 'MainController@question');
Route::get('/vote/{post_id}', 'QuestionController@votePost');
Route::get('/unvote/{post_id}', 'QuestionController@unvotePost');
Route::post('/question/answer', 'QuestionController@answer');
Route::post('/question/accept-answer', 'QuestionController@acceptAnswer');

Route::get('/tag/{tag}', 'MainController@tag');
Route::get('/about', function(){
    return view('about');
});

Route::post('/add-tags', 'AdminController@addTags');
// for testing only!
//Route::get('/seed', 'MainController@seed');

Route::get('test', function () {
	echo "Test without leading '/'";
});

Route::get('test/foo', function () {
	echo "test/foo";
});

Route::get('hello/{name}',function($name){
   echo 'Hello, '.$name;
});

//Route::get('user/{name?}',function($name = 'Default'){
//   echo "User: ".$name;
//});

Route::get('role',[
   'middleware' => 'Role: editor, editor2', //use a specific middleware "Role" passing "editor" and "editor2" as a param
   'uses' => 'TestController@index', //let TestController, index function, to determine what should happen
]);

Route::get('terminate', [
	'middleware' => 'terminate',
	'uses' => 'ABCController@index',
]);

Route::get('usercontroller/path',[
   'middleware' => 'First',
   'uses' => 'UserController@showPath'
]);

Route::resource('my', 'MyController'); 
// let MyController handle all URL that starts with /my
// handled path:
// Verb			Path			Method		Route Name
// GET 			/my				index		my.index
// GET			/my/create		create		my.create
// POST			/my				store		my.store
// GET			/my/{my}		show		my.show
// GET			/my/{my}/edit	edit		my.edit
// PUT/PATCH	/my/{my}		update		my.update
// DELETE		/my/{my}		destroy		my.destroy

class MyClass{
   public $foo = 'bar';
   private $bar = 'foo';
}
Route::get('/myclass','ImplicitController@index');
Route::get('foo/bar', 'UriController@index' );

Route::get('/register', function(){
    return view('register');
});
Route::post('/user/register', 'UserRegistration@postRegister');


Route::get('/cookie/set', 'CookieController@setCookie');
Route::get('/cookie/get', 'CookieController@getCookie');

Route::get('basic_response', function(){
   return 'Hello world';
});

Route::get('header', function() {
   return response("Hello", 200)->header('Content-Type', 'text/html')
       ->withcookie('expiredin_1', 'Virat Gandhi', 1);
});

Route::get('json', function() {
   return response()->json(['name' => 'Jacky', 'lastName' => 'Efendi']);
});

Route::get('test', function() {
    $data = ["name" => "Jacky"];
    return view('test', $data);
});

Route::get('share1', function() {
    return view('share1');
});
Route::get('share2', function() {
    return view('share2');
});

Route::get('blade', function() {
    return view('page', ["name" => "Jacky Efendi"]);
});

Route::get('user/profile', ['as' => 'asd', function() { //this route is given the name 'asd' using the keyword 'as'
    return view('profile');
}]);
Route::get('redirect', function() {
    return redirect()->route('asd'); //redirect to the route named 'asd'
});

Route::get('rr','RedirectController@index'); //this route use RedirectController@index action
Route::get('redirect2', function(){
    return redirect()->action('RedirectController@index'); //redirect to the route that use RedirectController@index
});

Route::get('createform', 'StudInsertController@insertform');
Route::post('create', 'StudInsertController@insert');
Route::get('stud', 'StudViewController@index');

Route::get('view/{id}', 'StudUpdateController@detail');
Route::get('edit/{id}', 'StudUpdateController@updateform');
Route::post('edit/submit/{id}', 'StudUpdateController@update');
Route::get('delete/{id}', 'StudUpdateController@delete');
Route::get('compare/{id}/{id2}', 'StudUpdateController@compare');

Route::get('localization/{locale}', 'LocalizationController@index');

Route::get('session/view', 'SessionController@accessSessionData');
Route::get('session/put', 'SessionController@putSessionData');
Route::get('session/delete', 'SessionController@deleteSessionData');

Route::get('/validation','ValidationController@showform');
Route::post('/validation','ValidationController@validateform');

Route::get('404', function (){
    abort(404);
});

Route::get('facadeex', function (){
    return TestFacades::testingFacades();
});

//Route::get('test', 'ImplicitController');
// Implicit controller routes let the Controller handle all paths with the prefix /test
// The controller must define methods such as 
// - getProfile() to handle GET /test/profile path
// - getProfile($num) to handle GET /test/profile/1 path
// - postProfile() to handle POST /test/profile path
// nevermind, it's deprecated


