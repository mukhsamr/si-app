<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Models\Sbt\Student;
use App\Models\Student as AppStudent;
use App\Models\Santri\User as SantriUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(): JsonResponse
    {
        return response()->json([
            'students' => Student::select('id', 'name', 'nickname')->orderBy('name')->get(),
            'message' => 'Get all students'
        ], 200);
    }

    function show(Student $student): JsonResponse
    {
        return response()->json([
            'student' => $student->append('age'),
            'message' => 'Get student'
        ], 200);
    }

    function notes(Student $student): JsonResponse
    {
        return response()->json([
            'notes' => $student->notes()->withAuthor()->latest()->get(),
            'message' => 'Get all notes'
        ], 200);
    }

    function latestNote(Student $student): JsonResponse
    {
        return response()->json([
            'note' => $student->latestNote()->withAuthor()->latest()->first(),
            'message' => 'Get latest note'
        ], 200);
    }



    // SANTRI-API
    function getPlans(Student $student): JsonResponse
    {
        $student = SantriUser::firstWhere('username', $student->nis);
        return response()->json([
            'plans' => $student->plans()->get(),
            'message' => 'Get all plans'
        ], 200);
    }

    function getPlan(Student $student, string $planId): JsonResponse
    {
        $student = SantriUser::firstWhere('username', $student->nis);
        return response()->json([
            'plan' => $student->plans()->with('planDetails')->find($planId),
            'message' => 'Get plan'
        ], 200);
    }

    function getLatestPlan(Student $student): JsonResponse
    {
        $student = SantriUser::firstWhere('username', $student->nis);
        $plan = $student->latestPlan()->first();

        if ($plan) {
            $plan->count_plan = $student->plans()->count();
        }

        return response()->json([
            'plan' => $plan,
            'message' => 'Get latest plans'
        ], 200);
    }



    // APP-API
    function getBio(Student $student): JsonResponse
    {
        $student = AppStudent::where('nis', $student->nis)->with('family')->first();
        return response()->json([
            'student' => $student,
            'message' => 'Get student biodata'
        ], 200);
    }
}
