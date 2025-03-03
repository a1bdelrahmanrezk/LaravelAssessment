<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = User::find(auth()->id());
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'token_type' => 'Bearer',
                'status' => true,
                'statusCode' => 200,
            ], 200);
        }
        return response()->json([
            'message' => 'Creadentials not Exist',
            'status' => true,
            'statusCode' => 401
        ], 401);
    }
}
