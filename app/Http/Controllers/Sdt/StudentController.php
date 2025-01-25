<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Models\Sdt\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'students' => Student::with('devices')
                ->where('name', 'like', '%' . $request->name . '%')
                ->orderBy('name')
                ->get()
        ], 200);
    }

    function show(string $uid): JsonResponse
    {
        try {
            return response()->json([
                'student' => Student::where('uid', $uid)->with([
                    'devices' => fn($query) => $query->isNotLoaned()
                ])->firstOrFail()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => $e
            ], 404);
        }
    }

    function nameOnly()
    {
        return response()->json([
            'success' => true,
            'students' => Student::select('id', 'name')
                ->orderBy('name')
                ->get()
        ], 200);
    }

    function update(Request $request): JsonResponse
    {
        return response()->json([], 200);
    }
}
