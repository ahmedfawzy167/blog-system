<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\User;
use App\Models\Type;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
   {
     if(request('term')) {
        $term = request('term');
        $users = User::with('type')->where('name', 'LIKE', "%$term%")->paginate(10);
     } else {
        $users = User::with('type')->paginate(10);
     }
      return view('users.index', compact('users'));
   }

    public function create()
    {
        $types = Type::all();
        $roles = Role::all();
        return view('users.create',compact('types','roles'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email'=> 'required|email|string|unique:users|max:200',
            'password' => 'required|string|min:6',
            'type_id' => 'required|numeric|gt:0',
            'role_id' => 'required|numeric|gt:0',
       ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type_id = $request->type_id;
        $user->save();

        $roleId = $request->role_id;
        $role = Role::findOrFail($roleId);
        $user->roles()->attach($role, ['user_id' => $user->id]);

        Session::flash('message','User is Created Successfully');
        return redirect(route('users.index'));
    }

  public function show($id)
 {
    $user = User::with(['type','roles','posts'])->findOrFail($id);
    return view('users.show',compact('user'));
 }

  public function edit($id)
  {
    $user = User::find($id);
    $types = Type::all();
    $roles = Role::all();
    return view('users.edit',compact('user','types','roles'));
  }

  public function update(Request $request,$id)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email'=> 'required|string|max:400',
        'password' => 'required|min:10',
        'type_id' => 'required|numeric|gt:0',
        'role_id' => 'required|numeric|gt:0',
     ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->type_id = $request->type_id;
    $user->save();

    $roleId = $request->role_id;
    $role = Role::findOrFail($roleId);
    $user->roles()->attach($role, ['user_id' => $user->id]);

    Session::flash('message','User is Updated Successfully');
    return redirect(route('users.index'));
  }

  public function destroy($id)
 {
    $user = User::findOrFail($id);
    $user->delete();
    Session::flash('message', 'User is Deleted Successfully');
    return redirect(route('users.index'));
 }

}


