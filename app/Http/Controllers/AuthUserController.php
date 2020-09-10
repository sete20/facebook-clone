<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\user as userResource;
class AuthUserController extends Controller
{
    public function show(){
        return new userResource(auth()->user());
    }
}
