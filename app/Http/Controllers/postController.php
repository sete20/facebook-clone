<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\post;
use App\Http\resources\post as PostResource;
use App\Http\resources\postCollection;

class postController extends Controller
{
    public function index(request $request){
        return new postCollection($request->user()->posts);
    }
    public function store(){
        $data = request()->validate([
            'data.attributes.body'=> ''
        ]);
        // dd($data);

         $post = request()->user()->posts()->create($data['data']['attributes']);
        return new PostResource($post);
        //  return response(201);
    }

}
