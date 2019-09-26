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

Route::get('/', 'PostController@index')->name('posts');

Route::get('/home', 'HomeController@index')->name('home');


//user routes
Route::get('/user/profile', 'UserController@show')->name('profile');
Route::get('/user/profile/edit', 'UserController@edit')->name('profile.edit');
Route::put('/user/profile/edit', 'UserController@update')->name('profile.update');
Route::post('/user/profile/edit', 'UserController@updateImage')->name('image.update');
Route::get('/user/avatar/{filename}', 'UserController@showImage')->name('image.show');
