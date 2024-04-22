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
    public function index()
    {
        $posts = Post::count();
        $categories = Category::count();

        //fetch the Recent Users//
        $recentUsers = User::where('created_at', '>=', Carbon::now()->subDays(3))->count();

        //fetch the Latest Posts This Month//
        $postsThisMonth = Post::whereMonth('created_at',2)->get();
        return view('dashboard',get_defined_vars());
    }

    public function search(Request $request)
    {
        $term = request('term');
        $user = User::whereFirst('name',$term);
        return view('search',compact('user'));
    }


}
