<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function login(Request $request): JsonResponse
    {
        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user?->password)) {
            return response()->json([
                'message' => 'Wrong credentials !!',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ], 200);
    }

    function logout(Request $request): JsonResponse
    {
        if ($request->user()->currentAccessToken() == null) {
            return response(status: 401);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'token' => null
        ], 200);
    }
}
