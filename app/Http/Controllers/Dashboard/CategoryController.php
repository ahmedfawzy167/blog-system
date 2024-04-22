<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(3);
        return view('categories.index',compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
      ]);

    if($validator->fails()) {
       return redirect()->back()->withErrors($validator)->withInput();
    }

    //file upload//
    $img = $request->file('image');
    $ext = $img->getClientOriginalExtension();
    $location = '/public';
    $filename= time().'.'.$ext;
    $img->storeAs($location,$filename);

    $category = new Category();
    $category->name = $request->name;
    $category->image = $filename;
    $category->save();

    Session::flash('message','Category is Created Successfully');
    return redirect(route('categories.index'))->withInput();

   }

  public function show($id)
  {
     $category = Category::with('posts')->findOrFail($id);
     return view('categories.show',get_defined_vars());
  }

   public function edit($id)
   {
     $category = Category::findOrFail($id);
     return view('categories.edit',get_defined_vars());
   }

  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $category = Category::find($id);
    $category->name = $request->name;

    if($request->hasFile('image')){
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $location = '/public';
        $filename= time().'.'.$ext;
        $img->storeAs($location,$filename);
        $category->image = $filename;
    }
        $category->save();

     Session::flash('message','Category is Updated Successfully');
     return redirect(route('categories.index'))->withInput();
   }

  public function destroy($id)
  {
    $category = Category::findOrFail($id);
    $category->delete();
    Session::flash('message','Category is Trashed Successfully');
    return redirect(route('categories.index'));
  }
 public function trashed()
 {
    $trashedCategories = Category::onlyTrashed()->get();
    return view('categories.trash',get_defined_vars());
 }

 public function restore($id)
 {
   $category = Category::withTrashed()->findOrFail($id);
   $category->restore();

   Session::flash('message','Category is Restored Successfully');
   return redirect(route('categories.index'))->withInput();
 }

 public function delete($id)
 {
   $category = Category::withTrashed()->findOrFail($id);
   $category->forceDelete();

   Session::flash('message','Category is Permanently Deleted Successfully');
   return redirect(route('categories.index'))->withInput();
 }


}
