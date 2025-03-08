<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sbt\UserResource;
use App\Models\Sbt\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function login(Request $request): JsonResponse
    {
        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user?->password)) {
            return response()->json([
                'data' => [
                    'token' => null
                ],
                'message' => 'Wrong credentials !!',
                'status' => 'error'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token
            ],
            'message' => 'Success login',
            'status' => 'success'
        ], 200);
    }

    function logout(Request $request): JsonResponse
    {
        if ($request->user()->currentAccessToken() == null) {
            return response()->json([
                'data' => null
            ], 401);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'data' => null
        ], 200);
    }

    function user(Request $request): JsonResource
    {
        return UserResource::make($request->user());
    }
}
