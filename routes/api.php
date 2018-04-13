<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {

    //auth
    Route::post('/signup', 'UserController@signup');
    Route::post('/signin', 'UserController@signin');

    // posts
    Route::resource('posts', 'PostController', ['except' => ['create',]]);

    // categories
    Route::resource('categories', 'CategoryController', ['except' => ['create',]]);

    // comments
    Route::get('comments/{post_id}', 'CommentController@index');
    Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
});






