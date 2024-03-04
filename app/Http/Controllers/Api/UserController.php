<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserDetailsResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        if($users){
           if(request('page') > $users->lastPage()){
               return response()->json([
                'status'  => 'Error',
                'message' => 'Page Not Found'],404);
            }
        }

         return new UserResource($users);

    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        if($user != null){
            return new UserDetailsResource($user);
        }
        else{
            return response()->json([
             "status" => "Error",
             "message" => "User Not Found"
            ],404);
        }

    }

}
