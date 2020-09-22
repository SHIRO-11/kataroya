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

Route::resource('comments', 'CommentsController', ['only' => ['store','show','index']]);
Route::resource('users', 'UsersController');
Route::get('/', 'PostsController@index')->name('posts.index');
Route::resource('posts', 'PostsController', ['only' => ['show']]);




Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts', 'PostsController', ['except' => ['index','show']]);
    Route::post('ajaxlike', 'PostsController@ajaxlike')->name('posts.ajaxlike');
});

Auth::routes();
