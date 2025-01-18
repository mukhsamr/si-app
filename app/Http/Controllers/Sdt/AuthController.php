<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Models\Sdt\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function login(Request $request): JsonResponse
    {
        $user = User::where('username', $request->username)->firstOrFail();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Success login',
            'token' => $token,
        ], 200);
    }

    function logout(Request $request): JsonResponse
    {
        if ($request->user()->currentAccessToken() == null) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Success logout',
            'token' => null
        ], 200);
    }

    function user(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'user' => $request->user()
        ], 200);
    }
}
