<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\LikeDetailsResource;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::paginate(2);
        if($likes){
         if(request('page') > $likes->lastPage()){
            return response()->json([
             'message' => 'Like Not Found'],404);
         }

        }
        return new LikeResource($likes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|gt:0',
            'user_id' => 'required|gt:0',
            'comment_id' => 'required|numeric|gt:0',
        ]);

        if($validator->fails()) {
           return response()->json($validator->errors()->toJson(),400);
        }

        $like = new Like();
        $like->post_id = $request->post_id;
        $like->user_id = $request->user_id;
        $like->comment_id = $request->comment_id;
        $like->save();

        return response()->json([
            "status" => 200,
            "message" => "Like Created Successfully!",
            "like" => $like
        ]);
    }

    public function show($id)
    {
        $like = Like::find($id);
        if($like != null){
            return new LikeDetailsResource($like);
        }
        else{
            return response()->json([
             "status" => "Error",
             "message" => "Like Not Found"
            ],404);
        }
    }








    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'comment_id' => 'required|numeric|gt:0',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $like = Like::find($id);
        $like->post_id = $request->post_id;
        $like->user_id = $request->user_id;
        $like->comment_id = $request->comment_id;
        $like->save();

        return response()->json([
            "status" => 200,
            "message" => "Like Updated Successfully!",
            "like" => $like
        ]);

    }


    public function destroy($id)
    {
       $like = Like::find($id);
       if($like!= null){
        $like->delete();
        return response()->json([
         "status" => 200,
         "message" => "Like is Deleted"
        ]);
       }
       else{
        return response()->json([
            "message" => "This ID Not Correct"
        ]);
       }
    }



}
