<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\PostDetailsResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3);
        if($posts){
         if(request('page') > $posts->lastPage()){
            return response()->json([
             'message' => 'Post Not Found'],404);
         }

        }
          return new PostResource($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100',
            'content' => 'required|string|max:1000',
            'user_id' => 'required|numeric|gt:0',
            'category_id' => 'required|numeric|gt:0',
            'publication_date' => 'nullable|date_format:U',
        ]);

        if($validator->fails()) {
           return response()->json($validator->errors()->toJson(),400);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->publication_date = $request->publication_date;
        $post->save();

        return response()->json([
            "status" => 200,
            "message" => "Post Created Successfully!",
            "post" => $post
        ]);

    }

    public function show($id)
    {
        $post = Post::find($id);
        if($post != null){
           return new PostDetailsResource($post);
        }
        else{
            return response()->json([
             "message" => "Post Not Found"
            ],404);
        }

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100',
            'content' => 'required|string|max:1000',
            'user_id' => 'required|numeric|gt:0',
            'category_id' => 'required|numeric|gt:0',
            'publication_date'  => 'nullable|date|after:yesterday',
         ]);

         if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
         }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->publication_date = $request->publication_date;
        $post->save();

        return response()->json([
            "status" => 200,
            "message" => "Post Updated Successfully!",
            "post" => $post
        ]);

    }

    public function destroy($id)
    {
       $post = Post::find($id);
       if($post!= null){
        $post->delete();
        return response()->json([
         "status" => 200,
         "message" => "Post is Deleted"
        ]);
       }

       else{
        return response()->json([
            "message" => "This ID Not Correct"
           ]);
       }
    }
}
