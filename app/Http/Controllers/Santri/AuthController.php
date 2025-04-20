<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Http\Resources\Santri\UserResource;
use App\Models\Santri\User;
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

    function user(Request $request): JsonResource
    {
        $user = $request->user();
        return UserResource::make($user->load('profile'))
            ->additional([
                'message' => 'Get user',
                'status' => 'success'
            ]);
    }
}
