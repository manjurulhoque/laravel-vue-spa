<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    // posts
    Route::resource('posts', 'PostController', ['except' => ['create',]]);
    // categories
    Route::resource('categories', 'CategoryController', ['except' => ['create',]]);

    // comments
    Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
});






