<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admins for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password'=> 'required|string|min:8',
            'captcha' => 'required|captcha',
        ],[
            'captcha' =>  'Please Match the Captcha Letters',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(!$admin = Admin::where('email',$request->email)->first()){
            return redirect()->back()->withErrors(['email' => 'This Email Doesn\'t Match Our Records']);
        }

        if(!Hash::check($request->password,$admin->password)) {
            return redirect()->back()->withErrors(['password' => 'Incorrect Password']);
        }

         if(Auth::guard('admin')->attempt($request->only('email','password'),$request->get('remember'))){
           session()->flash('message','Welcome Administrator');
           session()->regenerate();
        }
        return redirect()->intended();
    }

  public function logout(Request $request)
   {
     Auth::guard('admin')->logout();
     $request->session()->invalidate();
     $request->session()->regenerateToken();
     return redirect('login');
   }

}
