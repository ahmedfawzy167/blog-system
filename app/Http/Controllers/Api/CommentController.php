<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\CommentDetailsResource;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(2);
        if($comments){
         if(request('page') > $comments->lastPage()){
            return response()->json([
             'message' => 'Comment Not Found'],404);
         }

        }
        return new CommentResource($comments);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|gt:0',
            'user_id' => 'required|gt:0',
            'content' => 'required|string|max:3000',
        ]);

        if($validator->fails()) {
           return response()->json($validator->errors()->toJson(),400);
        }

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            "status" => 200,
            "message" => "Comment Created Successfully!",
            "comment" => $comment
        ]);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'content' => 'required|string|max:3000',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $comment = Comment::find($id);
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            "status" => 200,
            "message" => "Like Updated Successfully!",
            "comment" => $comment
        ]);

    }
    public function show($id)
    {
        $comment = Comment::find($id);
        if($comment != null){
            return new CommentDetailsResource($comment);
        }
        else{
            return response()->json([
             "status" => "Error",
             "message" => "Comment Not Found"
            ],404);
        }
    }


    public function destroy($id)
    {
        $comment = Comment::find($id);
        if($comment != null){
          $comment->delete();
          return response()->json([
            'status' => 200,
             'message'  => 'Comment is Deleted Successfully!'
          ]);
        }
        else{
            return response()->json([
             'status' => 'Error',
             'message' => 'Comment Not Found'
            ],404);
        }


    }


}
