<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Models\Sdt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'students' => Student::with('devices')
                ->where('name', 'like', '%' . $request->name . '%')
                ->get()
        ], 200);
    }

    function update(Request $request): JsonResponse
    {
        return response()->json([], 200);
    }
}
