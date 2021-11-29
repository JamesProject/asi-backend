<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request){

        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if($request->remember_me)
            \Laravel\Passport\Passport::tokensExpireIn(now()->addMonth(1));

        if(auth('web')->attempt($login_credentials)){
            $token_token= auth('web')->user()->createToken('asi');
            return response()->json([
                'access_token' => $token_token->accessToken,
                'token_type' => 'bearer',
                'expires_in' => $token_token->token->expires_at->diffInSeconds(Carbon::now())
            ]
            , 200);
        }
        else
            return response()->json(['error' => 'Unauthorised Access'], 401);
    }
    public function logout(){
        $user = \Auth::user()->token();
        $user->revoke();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
    public function me(){
        return response()->json(\Auth::user());
    }
    public function refresh(){

    }
}
