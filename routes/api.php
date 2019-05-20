<?php

//questions routes
Route::apiResource('question','QuestionController');

//categories routes
Route::apiResource('category', 'CategoryController');

//replies routes
Route::apiResource('question/{question}/reply', 'ReplyController');

//like routes
Route::post('like/{reply}', 'LikeController@like');
Route::delete('like/{reply}', 'LikeController@dislike');


//notifications
Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('payload', 'Auth\AuthController@payload');
    Route::post('signup', 'Auth\SignUpController@register');

});

