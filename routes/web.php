<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

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

Route::get('/','HomeController@allPosts');

Route::post('/','HomeController@index');

Route::post('/profile/{name}','ProfileController@index');

Route::post('/single/{postID}','ProfileController@index');

Route::get('login', function () {
    return view('login');
});

Route::get('reset', function () {
    return view('reset');
});

// Route::get('profile/{name}', function ($name) {
//     return view('profile',['name' => $name]);
// });

Route::get('profile/{name}', function ($name) {
  $result = ProfileController::profile($name);
  return view('profile',['userPosts' => $result]);
});

Route::get('single/{postID}', function ($postID) {
  $result = PostController::single($postID);
  return view('single',['userPosts' => $result]);
});

Route::post('login', 'AuthenticateController@authenticate');

// get Users
Route::get('/users', 'Users@index');

// post actions
Route::get('/postaction', 'PostController@index');

// user actions
Route::get('/useraction', 'UserController@index');

// user actions
Route::get('/userchat', 'UserController@index');

// user actions
Route::get('/userrequest', 'UserController@index');

// Cricket score
Route::get('/cricketscore', 'CricketController@index');


Route::get('/more','MoreController@index');