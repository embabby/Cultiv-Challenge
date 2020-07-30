<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminController extends Controller
{
    public $successStatus = 200;


    //Users Listing
    public function getUsers()
    {
        return User::where('role','user')->get();
    }


    public function showUser($id)
    {	

    	return $user = User::with('getPosts')->find($id);
    }

    public function updateUser(Request $request, User $user)
    {
         $user->update($request->all());
        return response()->json([$user, 200]);
    }


    public function deleteUser(User $user)
    {
        $user->getPosts()->delete();
        $user->delete();
        return response()->json(null, 204);
    }


    public function showUserPost(Post $post)
    {	
    	return $post;
    }


    public function updateUserPost(Request $request, Post $post)
    {
    
         $post->update($request->all());
        return response()->json([$post, 200]);
    }

    public function deleteUserPost(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
