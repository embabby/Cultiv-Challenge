<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;

use App\Http\Resources\UserCollection;



class UserResourceController extends Controller
{
    public function getUser() {
    	// return new UserResource(auth()->user());
    	return new UserCollection(User::paginate());
    }


    public function getUserCollection() {
    	return UserResource::collection(User::where('role','user')->get());
    }


    public function getUserCollections() {
    	return new UserCollection(User::all());
    }
}
