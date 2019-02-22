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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return Auth::user()->test();
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/profile/{slug}','ProfileController@index');

	Route::get('/changePhoto',function(){
		return view('profile.pic');
	});

	Route::post('/uploadPhoto','ProfileController@uploadPhoto');

	Route::get('/editProfile','ProfileController@editProfileForm');

	Route::post('updateProfile','ProfileController@updateProfile');

	Route::get('/findFriends','ProfileController@findFriends');

	Route::get('/addFriend/{id}','ProfileController@sendRequest');

	Route::get('/requests','ProfileController@requests');

	Route::get('/accept/{name}/{id}','ProfileController@accept');

	Route::get('/requestRemove/{id}','ProfileController@requestRemove');

	Route::get('/friends','ProfileController@friends');

	Route::get('/unfriend/{id}', function($id){
	    $loggedUser = Auth::user()->id;

	    DB::table('friendships')
	    ->where('requester', $loggedUser)
	    ->where('user_requested', $id)
	    ->delete();

	    DB::table('friendships')
	    ->where('user_requested', $loggedUser)
	    ->where('requester', $id)
	    ->delete();

	    return back()->with('msg', 'You are now not friend with this person');
        });
});

Route::get('/logout','Auth\LoginController@logout');