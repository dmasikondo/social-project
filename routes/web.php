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

Auth::routes();

Route::get('/logout',[
	'uses' => 'HomeController@logout',
	'as' => 'logout',
]);
/**
 * display search results of users
 */
Route::get('/search',[
	'uses' =>'SearchController@getResults',
	'as' => 'search',
]);
/**
 * display a user's profile
 */
Route::get('/user/{email}',[
	'uses' => 'ProfileController@getProfile',
	'as' =>'user-profile',
]);
/**
 * form to edit user profile
 */
Route::get('/user-profile/edit',[
	'uses' =>'ProfileController@edit',
	'as' => 'user-profile.edit',
]);
/**
 * update user profile
 */
Route::patch('/user-profile/edit',[
	'uses' =>'ProfileController@update',
	'as' => 'post.user-profile',
]);
/**
 * list of friends
 */
Route::get('/friends',[
	'uses'=>'FriendController@index',
	'as' => 'friends',
]);
/**
 * add friend request
 */
Route::get('/friend/{usermail}/add',[
	'uses'=>'FriendController@addFriend',
	'as' => 'add-friend',
]);
/**
 * accept friend request
 */
Route::get('/friend/{usermail}/accept',[
	'uses'=>'FriendController@acceptFriend',
	'as' => 'accept-friend',
]);
/**
 * post a status
 */
Route::post('/status',[
	'uses'=>'StatusController@postStatus',
	'as' => 'status',
]);
/**
 * post a reply to a status
 */
Route::post('/status/{statusId}/reply',[
	'uses'=>'StatusController@postReply',
	'as' => 'status-reply',
]);

Route::get('like-status/{statusToLike}/like',[
	'uses' => 'LikeController@statusLike',
	'as' => 'like-status'
]);

Route::get('unlike-status/{statusToLike}/like',[
	'uses' => 'LikeController@statusUnlike',
	'as' => 'unlike-status'
]);