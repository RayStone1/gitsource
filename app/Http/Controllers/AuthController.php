<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\RegularExpressionTest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data=$request->validated();
        if(!Auth::attempt($data)){
            return response()->json([],401);
        }
        $token = Auth::user()->createToken('token user')->accessToken;

        return response()->json([
            "user"=>Auth::user(),
            "access_token"=>$token
        ],200);

    }

    public function logout()
    {
        $accessToken = auth()->user()->token();
        $accessToken->delete();
        return response()->json(['status' => 200]);
    }
}
