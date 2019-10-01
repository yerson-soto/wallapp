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


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


//user routes
Route::get('/user/find', 'UserController@index')->name('users');
Route::post('/user/find', 'UserController@index')->name('user.find');
Route::get('/user/{username}', 'UserController@show')->name('profile');
Route::get('/user/profile/edit', 'UserController@edit')->name('profile.edit');
Route::put('/user/profile/edit', 'UserController@update')->name('profile.update');
Route::post('/user/profile/edit', 'UserController@updateImage')->name('image.update');
Route::get('/user/avatar/{filename}', 'UserController@showImage')->name('image.show');


//posts routes
Route::get('/', 'PostController@index')->name('posts');
Route::get('/post/{post}', 'PostController@show')->name('post.show');
Route::post('/', 'PostController@store')->name('post.create');
Route::get('/post/image/{filename}', 'PostController@getPostImage')->name('post.image');
Route::delete('/post/delete/{post}', 'PostController@delete')->name('post.delete');


//likes routes
Route::get('/post/vote/{post}', 'LikeController@toggleVote')->name('toggleVote');

//comment routes
Route::post('/comment/store', 'CommentController@store')->name('comment.store');
