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

Route::get('/', 'PostsController@index')->name('posts.index');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UsersController');



Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', 'PostsController')->except('posts.index');
});

Auth::routes();
