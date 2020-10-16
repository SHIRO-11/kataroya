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

Route::resource('comments', 'CommentsController', ['only' => ['store','show','index']]);
Route::resource('users', 'UsersController');
Route::get('users/lanking/{period}', 'UsersController@lanking')->name('users.lanking');
Route::get('categories', 'CategoriesController@index')->name('categories.index');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');



Route::group(['prefix' => 'posts'], function () {
    Route::get('trend/{period}', 'PostsController@trend')->name('posts.trend');
    Route::get('search', 'PostsController@search')->name('posts.search');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('timeline', 'PostsController@timeline')->name('posts.timeline');
    });
});
Route::resource('posts', 'PostsController', ['only' => ['show']]);

Route::group(['prefix' => 'users/{user}'], function () {
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    Route::get('likeslist', 'UsersController@likeslist')->name('users.likeslist');
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('likeslist', 'UsersController@likeslist')->name('users.likeslist');
});




Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{user}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    });


    Route::resource('posts', 'PostsController', ['except' => ['index','show']]);
    Route::post('ajaxlike', 'PostsController@ajaxlike')->name('posts.ajaxlike');
});

Auth::routes();
