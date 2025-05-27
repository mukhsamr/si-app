<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\UserRequest;
use App\Http\Resources\Sdt\UserResource;
use App\Models\Sdt\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    function index(): JsonResource
    {
        return UserResource::collection(
            User::withCount('loans')->get()
        )->additional([
            'message' => 'Get user successfully',
            'status' => 'success'
        ]);
    }

    function store(UserRequest $request): JsonResource
    {
        $user = User::create($request->validated());

        return UserResource::make($user)
            ->additional([
                'message' => 'Add user successfully',
                'status' => 'success'
            ]);
    }

    function show(User $user): JsonResource
    {
        return UserResource::make($user)
            ->additional([
                'message' => 'Find user successfully',
                'status' => 'success'
            ]);
    }

    function update(UserRequest $request, User $user): JsonResource
    {
        $user->update($request->validated());

        return UserResource::make($user)
            ->additional([
                'message' => 'User updated successfully',
                'status' => 'success'
            ]);
    }

    function destroy(User $user): JsonResponse
    {
        if ($user->loans()->count() > 0) {
            return response()->json([
                'data' => null,
                'message' => 'User has loan',
                'status' => 'error'
            ]);
        }

        $user->delete();
        return response()->json([
            'data' => null,
            'message' => 'User deleted successfully',
            'status' => 'success'
        ]);
    }
}
