<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // check if user exists
        if(!User::where('username', $credentials['username'])->exists()) {
            return response()->json([
                'message' => 'User not registered',
            ], 404);
        }

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = auth()->user()->createToken('authToken')->plainTextToken;
        

        return response()->json([
            'user'  => new UserResource(auth()->user()),
            'token' => $token,
        ]);
    }

    public function getUserFromToken()
    {
        return new UserResource(auth()->user());
    }

    public function logout()
    {
        // revoke authToken
        auth()->user()->tokens()->delete();

        
        return response()->json([
            'message' => 'User logged out',
        ]);
    }
}
