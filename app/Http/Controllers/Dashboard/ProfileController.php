<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $admin = auth()->guard('admin')->user();
        return view('profile.show',compact('admin'));
    }
    public function edit()
    {
        $admin = auth()->guard('admin')->user();
        return view('profile.edit',compact('admin'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'email' => 'required|string|max:100',
            'current_password' => 'required|current_password',
            'new_password' => ['required',Password::defaults(),'confirmed'],
        ]);

        $admin = Admin::find($id);
        $admin->email = $request->email;
        $admin->password = bcrypt($request->new_password);
        $admin->save();

        Session::flash('message','Credentials Updated Successfully');
        return redirect()->route('profile.edit');
    }

}
