<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response([
            'success' => true,
            'data' => $user
           ], 200);
    }

    public function login(LoginRequest $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'success' => true,
                'access_token' => $token->accessToken,
                'user' => $user,
                'token_type' => 'bearer',
                ]);
        }

        else {
            return response()->json([
                'success' => false,
                'errors' => [
                   'message' => [
                      'Either Email or Password Invalid'
                    ]
                 ],
             ]);
        }
    }

    public function logout()
    {
        $token = Auth::user()->token();
        $token->revoke();

        return response()->json([
             'success' => true
           ]);
    }
}
