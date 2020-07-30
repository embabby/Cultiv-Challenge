<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
// use Illuminate\Support\Facades\Auth;
// use Validator;


class PostController extends Controller
{

	public function createPost(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        auth()->user()->posts()->sync($post, false);

        // return response()->json($post, 201);
        return response()->json(['message' => 'post created successfully!']);

    }

}