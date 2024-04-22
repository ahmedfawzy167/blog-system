<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if($request->has('term')) {
            $term = $request->term;
            $filter = $request->filter ?? 'title';

            if($filter === 'category_id') {
                $query->whereHas('category', function ($categoryQuery) use ($term) {
                $categoryQuery->where('name', 'LIKE', "%$term%");
            });
            }
            else{
                $query->where($filter, 'LIKE', "%$term%");
            }
        }

        $posts = $query->paginate(4);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::where('type_id',1)->get();
        return view('posts.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100',
            'content' => 'required|string|max:1000',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'user_id' => 'required|numeric|gt:0',
            'category_id' => 'required|numeric|gt:0',
            'publication_date' => 'nullable|date_format:U',
        ]);

        if($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        }

        //file upload//
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $location = '/public';
        $filename= time().'.'.$ext;
        $img->storeAs( $location,$filename);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $filename;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->publication_date = $request->publication_date;
        $post->save();

        Session::flash('message','Post is Created Successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with(['user','category'])->findOrFail($id);
        return view('posts.show', compact('post'));

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);
      $categories = Category::all();
      $users = User::where('type_id',1)->get();
      return view('posts.edit',get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(),[
          'title' => 'required|string|between:2,100',
          'content' => 'required|string|max:1000',
          'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
          'user_id' => 'required|numeric|gt:0',
          'category_id' => 'required|numeric|gt:0',
          'publication_date' => 'nullable|date|after:yesterday',
      ]);

      if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
      }

      $post = Post::findOrFail($id);

      $data = [
         'title' => $request->title,
         'content' => $request->content,
         'user_id' => $request->user_id,
         'category_id' => $request->category_id,
         'publication_date' => $request->publication_date,
      ];

      if($request->hasFile('image')) {
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $location = '/public';
        $filename = time() . '.' . $ext;
        $img->storeAs($location,$filename);
        $data['image'] = $filename;
     }

     $post->update($data);

     Session::flash('message','Post is Updated Successfully');
     return redirect(route('posts.index'));

   }

    public function destroy($id)
    {
       $post = Post::findOrFail($id);
       $post->delete();
       Session::flash('message','Post is Trashed Successfully');
       return redirect(route('posts.index'));
    }

    public function trashed()
    {
       $trashedPosts = Post::onlyTrashed()->get();
       return view('posts.trash',compact('trashedPosts'));
    }

    public function restore($id)
    {
       $post = Post::withTrashed()->findOrFail($id);
       $post->restore();

       Session::flash('message','Post is Restored Successfully');
       return redirect(route('posts.index'));
   }

   public function delete($id)
   {
     $post = Post::withTrashed()->findOrFail($id);
     $post->forceDelete();

     Session::flash('message','Post is Permanently Deleted Successfully');
     return redirect(route('posts.index'));
   }
}
