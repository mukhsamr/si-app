<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Http\Requests\Santri\UserRequest;
use App\Models\Santri\User;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(): JsonResponse
    {
        return response()->json([
            'users' => User::with('profile')->get(),
            'message' => 'Get all users'
        ], 200);
    }

    function show(Student $student): JsonResponse
    {
        return response()->json([
            'user' => $student->load('family'),
            'message' => 'Get user'
        ], 200);
    }
}
