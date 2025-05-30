<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(): JsonResponse
    {
        return response()->json([
            'students' => Student::all(),
            'message' => 'Get all students'
        ], 200);
    }

    // function store(Request $request): JsonResponse
    // {
    //     return response()->json([
    //         'message' => ''
    //     ], 200);
    // }

    function show(Student $student): JsonResponse
    {
        $student->load([
            'family',
            'grades' => fn($query) => $query->whereActiveSemester(),
            'plps' => fn($query) => $query->whereActiveSemester()
        ]);

        return response()->json([
            'student' => $student,
            'message' => 'Get student'
        ], 200);
    }

    // function update(Request $request, string $id): JsonResponse
    // {
    //     return response()->json([
    //         'message' => ''
    //     ], 200);
    // }

    // function destroy(string $id): JsonResponse
    // {
    //     return response()->json([
    //         'message' => ''
    //     ], 200);
    // }
}
