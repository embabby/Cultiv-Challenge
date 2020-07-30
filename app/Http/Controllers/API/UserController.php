<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{


    public $successStatus = 200;


    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;


        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserData()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }



    public function updateUser(Request $request)
    {
        User::find(auth()->user()->id)->update($request->all());
        return response()->json(['success' => 'User Updated Successfully'], $this->successStatus);
    }


    //Posts
    public function getPosts()
    {
        return User::find(auth()->user()->id)->getPosts;
    }
 
    public function showPost(Post $post)
    {	
    	if(auth()->user()->id == $post->user_id) return $post;
    	else return response()->json(['This is not your post', 401]);
        
    }

    public function storePost(Request $request)
    {
        $post = Post::create([
        	'title' => $request->title,
        	'body' => $request->body,
        	'user_id' =>auth()->user()->id,
        ]);
        return response()->json($post, 201);

    }

    public function updatePost(Request $request, Post $post)
    {
    
         $post->update($request->all());

        return response()->json([$post, 200]);
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
