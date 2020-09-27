<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\resources\post as PostResource;
use App\Http\resources\postCollection;
use App\post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(request $request)
    {
        $friends = Friend::friendships();

        if ($friends->isEmpty()) {
            return new PostCollection(request()->user()->posts);
        }

        return new PostCollection(
            Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
                ->get()
        );
    }
    public function store()
    {
        $data = request()->validate([
            'body' => '',
        ]);
        // dd($data);

        $post = request()->user()->posts()->create($data);
        return new PostResource($post);
        //  return response(201);
    }
}
