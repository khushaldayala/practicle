<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // Authentication passed
            return response()->json([
                'status' => 200,
                'message' => 'User login successfully',
                'user' => Auth::user()
            ], 200);
        }
        return response()->json([
            'status' => 401,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'status' => 200,
            'message' => 'User logout successfully',
        ], 200);
    }
}
