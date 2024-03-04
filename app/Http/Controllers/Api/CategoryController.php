<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\CategoryDetailsResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(2);
        if($categories){
          if(request('page') > $categories->lastPage()){
                return response()->json(["message" => "Page Not Found"],404);
            }
        }
        return new CategoryResource($categories);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if($category != null){
          return new CategoryDetailsResource($category);
        }
        else{
            return response()->json([
             "status" => "Error",
             "message" => "Category Not Found"
            ],404);
        }

    }

}
