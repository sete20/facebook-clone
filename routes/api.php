<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    route::get('auth-user', 'AuthUserController@show');
    route::apiResources([
        '/posts' => 'postController',
        '/users' => 'userController',
        '/users/{user}/posts' => 'userPostController',
        '/friend-request' => 'FriendRequestController',
        '/friend-request-response' => 'FriendRequestResponseController'
    ]);
});
