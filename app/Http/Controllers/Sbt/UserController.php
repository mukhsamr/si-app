<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sbt\UserRequest;
use App\Http\Resources\Sbt\UserResource;
use App\Models\Sbt\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    function update(UserRequest $request, User $user): JsonResource
    {
        $user->update($request->validated());
        return UserResource::make($user)
            ->additional([
                'message' => 'User updated successfully',
                'status' => 'success'
            ]);
    }
}
