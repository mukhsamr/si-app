<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sdt\UserResource;
use App\Models\Sdt\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    function login(Request $request): JsonResponse
    {
        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'data' => [
                    'token' => null,
                    'user' => null
                ],
                'error' => 'Unauthenticated',
                'status' => 'error'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token,
                'user' => UserResource::make($user)
            ],
            'message' => 'Success login',
            'status' => 'success'
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
            'token' => null
        ], 200);
    }

    function user(Request $request): JsonResource
    {
        return UserResource::make($request->user())
            ->additional([
                'message' => 'Get auth user',
                'status' => 'success'
            ]);
    }
}
