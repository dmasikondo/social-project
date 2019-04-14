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

Route::get('/', [
	'uses' => 'HomeController@index',
	'as' => 'home',
]);

Route::get('/alert', function(){
	return redirect()->route('home')->with('info','You have signed in');
});

Auth::routes();

Route::get('/logout',[
	'uses' => 'HomeController@logout',
	'as' => 'logout',
]);
Route::get('/search',[
	'uses' =>'SearchController@getResults',
	'as' => 'search',
]);
