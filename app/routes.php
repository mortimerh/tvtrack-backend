<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', function()
{
	return View::make('home');
}));



Route::group(array("prefix" => "api"), function()
{

	Route::get('/users/{user_id}/shows', array('uses' => 'API_FollowedShowsController@index'))
				 ->where(array('user_id' => '[0-9]+'));

	Route::get('/users/{user_id}/shows/{show_id}', array('uses' => 'API_FollowedShowsController@show'))
				 ->where(array('user_id' => '[0-9]+', 'show_id' => '[0-9]+'));

	Route::post('/users/{user_id}/shows/{show_id}', array('uses' => 'API_FollowedShowsController@store'))
 				 ->where(array('user_id' => '[0-9]+', 'show_id' => '[0-9]+'));

 	Route::delete('/users/{user_id}/shows/{show_id}', array('uses' => 'API_FollowedShowsController@destroy'))
 				 ->where(array('user_id' => '[0-9]+', 'show_id' => '[0-9]+'));

});




Route::group( array('before' => 'auth'), function()
{
	Route::get('/profile', array('as' => 'profile', function()
	{
		return View::make('profile');
	}));

	Route::get('/users', array('as' => 'users', function()
	{
		$users = User::all();
		return View::make('users')->with('users', $users);
	}));
});

/* Auth routes (all filters are applied in controller) */
Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));

Route::post('/login', array('uses' => 'AuthController@postLogin'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));