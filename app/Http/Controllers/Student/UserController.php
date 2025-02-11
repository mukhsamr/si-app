<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UserRequest;
use App\Models\Student\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(): JsonResponse
    {
        return response()->json([
            'users' => User::all(),
            'message' => 'Get all users'
        ], 200);
    }

    function store(UserRequest $request): JsonResponse
    {
        $user = User::create([
            'username' => $request->username,
            'password' => $request->password
        ]);
        return response()->json([
            'user' => $user,
            'message' => 'User created'
        ], 200);
    }

    function show(User $user): JsonResponse
    {
        return response()->json([
            'user' => $user->with('profile'),
            'message' => 'Get user'
        ], 200);
    }

    function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->all());

        return response()->json([
            'user' => $user,
            'message' => 'User updated'
        ], 200);
    }

    function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted'
        ], 200);
    }
}
