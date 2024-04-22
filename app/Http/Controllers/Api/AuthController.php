<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|string|min:10',
            'type_id' =>   'required|gt:0',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'type_id'=>$request->input('type_id'),
        ]);

        $token = $user->createToken('blog token')->plainTextToken;
        $user->token = $token;

        return response()->json([
            'status' => 200,
            'message' => 'Registeration is Done',
            'user' => $user,
       ]);
}

  public function login(Request $request)
  {
     $validator = Validator::make($request->all(),[
        'email' => 'required|string|email|max:100',
        'password' => 'required|string|min:10',
        'remember_token' => 'required|nullable',
    ]);

    if($validator->fails()){
        return response()->json($validator->errors()->toJson(),400);
    }

    $user = User::where('email',$request->email)->first();
    if(!$user){
        return response()->json(['email' => 'This Email Doesn\'t Match Our Records!'], 401);
    }

    if(!Hash::check($request->password,$user->password ) ){
       return response()->json(['password' => 'Wrong Password!'],401);
    }

    if($request->has('remember_token')){
        $user->remember_token = $request->remember_token;
        $user->save();
      }

    $credentials = $request->only(['email','password']);
    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $token = $user->createToken('blog token')->plainTextToken;
        $user->token = $token;
        return response()->json([
            'status' => 200,
            'message' => 'Login Successfully',
            'user' => $user,
            'remember_token' => $user->remember_token,
        ]);
    }
  }
   public function logout(Request $request)
   {
      $token = $request->bearerToken();

      if(!$token) {
        return response()->json([
          'message' => 'Token Not Found'
         ],401);
      }

      if($request->user()->currentAccessToken()){
         $request->user()->currentAccessToken()->delete();
         return response()->json([
            'status' => 200,
            'message' => 'Logged Out Successfully',
         ]);
      }

      return response()->json([
        'status' => 500,
        'message' => 'Something Went Wrong'
      ]);

   }

}
