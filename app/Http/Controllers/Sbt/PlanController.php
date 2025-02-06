<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Models\Sbt\Plan;
use App\Models\Sbt\PlanDetail;
use App\Models\Sbt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $student = $request->student_id ? Student::find($request->student_id) : $user->student;

        if (! $student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $plans = $student->plans()->latest()->get();

        $plans->transform(function ($plan) {
            $plan->is_editable = $plan->created_at->isToday();
            return $plan;
        });

        return response()->json([
            'plans' => $plans
        ], 200);
    }

    function store(Request $request)
    {
        $user = Auth::user();

        try {
            $plan = $user->student->plans()->create($request->all());

            return response()->json([
                'plan' => $plan,
                'message' => 'Plan created successfully'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function show(Plan $plan)
    {
        return response()->json([
            'plan' => $plan->load('plan_details')
        ], 200);
    }

    function latest(Request $request): JsonResponse
    {
        $user = Auth::user();

        $student = $request->student_id
            ? Student::find($request->student_id)
            : $user->student;

        return response()->json([
            'plan' => $student
                ->plans()
                ->with('plan_details')
                ->latest()
                ->first(),
            'count' => $student->plans()->count()
        ], 200);
    }

    function update(Request $request, Plan $plan)
    {
        try {
            PlanDetail::updateOrCreate(
                ['plan_id' => $plan->id, 'type' => $request->type],
                ['content' => $request->content]
            );

            return response()->json([
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function destroy(Plan $plan)
    {
        try {
            $plan->delete();
            return response()->json([
                'message' => 'Plan deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
