<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\user as UserResource;
class userController extends Controller
{
    public function show(User $user){
        return new UserResource($user);
    }
}
