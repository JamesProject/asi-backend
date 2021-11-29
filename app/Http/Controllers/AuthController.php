<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function __invoke()
    {
        return 'asd';
    }
    public function logout(){
        $user = \Auth::user()->token();
        $user->revoke();
        //return 401 error
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
    public function me(){
        return response()->json(\Auth::user());
    }
    public function refresh(){

    }
}
