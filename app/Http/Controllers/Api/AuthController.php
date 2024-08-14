<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($credentials)) {
            return response([
                'message' => 'Login failed!'
            ], 401);
        }
        $user = $request->user();
        $token = $user->createToken('token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

     //logout
     public function logout(Request $request)
     {
         $request->user()->currentAccessToken()->delete();
         return response()->json([
             'message' => 'Logout success',
         ]);
     }
}
