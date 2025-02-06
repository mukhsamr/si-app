<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Models\Sbt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(Request $request): JsonResponse
    {
        return response()->json([
            'students' => Student::all()
        ], 200);
    }

    function show(Student $student): JsonResponse
    {
        return response()->json([
            'student' => $student
        ], 200);
    }

    function onlyName(): JsonResponse
    {
        return response()->json([
            'students' => Student::select('id', 'name', 'nickname')->orderBy('name')->get()
        ],);
    }
}
