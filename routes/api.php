<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('register', 'API\UserController@register'); //User Registeration
Route::post('login', 'API\UserController@login'); //User Or Admin Login


//User Routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'user'], function() {
	Route::post('details', 'API\UserController@getUserData'); //to get user details
	Route::post('update', 'API\UserController@updateUser');	//to update user info

	Route::post('post/create', 'API\PostController@createPost'); //to create post by auth user

	Route::post('getUser', 'API\UserResourceController@getUser'); //for API Resoure
	Route::get('getUserCollection', 'API\UserResourceController@getUserCollection');
	Route::get('getUserCollections', 'API\UserResourceController@getUserCollections');

	//UserPosts
	Route::get('posts', 'API\UserController@getPosts'); //to fetch auth user posts
	Route::get('posts/{post}', 'API\UserController@showPost'); //to show post by auth user
	Route::post('posts', 'API\UserController@storePost'); //to create post by auth user
	Route::put('posts/{post}', 'API\UserController@updatePost'); //create post by auth user
	Route::delete('posts/{post}', 'API\UserController@deletePost'); //delete post

});


//Admin Routes
Route::group(['middleware' => ['auth:api','admin'], 'prefix' => 'admin'], function() { 

	//UserCRUD
	Route::get('users', 'API\AdminController@getUsers'); //to fetch all users by admin
	Route::get('users/{id}', 'API\AdminController@showUser'); //Show user and his Posts
	Route::put('users/{user}', 'API\AdminController@updateUser'); //update user info by admin
	Route::delete('users/{user}', 'API\AdminController@deleteUser'); //to remove user and his posts

	//UserPostsCRUD
	Route::get('posts/{post}', 'API\AdminController@showUserPost'); //to get specific post for user
	Route::put('posts/{post}', 'API\AdminController@updateUserPost'); //to update specific post
	Route::delete('posts/{post}', 'API\AdminController@deleteUserPost'); //to remove specific post

});


// Route::resource('posts', 'PostController');
// Route::post('register', 'Auth\RegisterController@register');
// Route::post('logout', 'Auth\LoginController@logout');







