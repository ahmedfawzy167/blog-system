<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $posts = Post::count();
        $categories = Category::count();

        //fetch the Recent Users//
        $recentUsers = User::where('created_at', '>=', Carbon::now()->subDays(3))->count();

        //fetch the Latest Posts This Month//
        $postsThisMonth = Post::whereMonth('created_at',2)
        ->whereYear('created_at', Carbon::now()->year)
        ->get();
        return view('dashboard',compact('posts','categories','recentUsers','postsThisMonth'));
    }


    public function search(Request $request)
    {
        $term = request('term');
        $user = User::where('name',$term)->first();
        return view('search',compact('user'));
    }


}
