<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\UserRequest;
use App\Models\Sdt\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'users' => User::all()
        ], 200);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $request->password = Hash::make($request->password);

        return response()->json([
            'message' => 'Success',
            'user' => User::create($request->all())
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'user' => $user
        ], 200);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->all());
        return response()->json([
            'message' => 'Success',
            'user' => $user
        ], 200);
    }

    public function destroy(User $user): JsonResponse
    {
        return response()->json([
            'message' => $user->delete()
        ], 200);
    }
}
