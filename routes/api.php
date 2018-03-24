<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function (){
    Route::resource('posts', 'PostController', ['except' => ['create',]]);
});






