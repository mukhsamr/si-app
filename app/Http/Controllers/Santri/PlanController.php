<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Http\Requests\Santri\PlanDetailRequest;
use App\Http\Requests\Santri\PlanRequest;
use App\Models\Santri\Plan;
use App\Models\Santri\PlanDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    function index(Request $request): JsonResponse
    {
        $plans = $request->user()
            ->plans()
            ->latest()
            ->get();

        $plans->transform(function ($plan) {
            $plan->is_editable = $plan->created_at->isToday();
            return $plan;
        });

        return response()->json([
            'plans' => $plans,
            'message' => 'Get all plans'
        ], 200);
    }

    function store(PlanRequest $request): JsonResponse
    {
        $plan = $request
            ->user()
            ->plans()
            ->create($request->all());

        return response()->json([
            'plan' => $plan,
            'message' => 'Plan created'
        ], 201);
    }

    function show(Plan $plan): JsonResponse
    {
        return response()->json([
            'plan' => $plan->load('planDetails'),
            'message' => 'Get plan'
        ], 200);
    }

    function update(PlanDetailRequest $request, Plan $plan): JsonResponse
    {
        PlanDetail::updateOrCreate(
            ['plan_id' => $plan->id, 'type' => $request->type],
            ['content' => $request->content]
        );

        return response()->json([
            'message' => 'Plan updated'
        ], 200);
    }

    function destroy(Plan $plan): JsonResponse
    {
        $plan->delete();
        return response()->json([
            'message' => 'Plan deleted'
        ], 200);
    }

    function getLatestPlan(Request $request): JsonResponse
    {
        $latest_plan = $request
            ->user()
            ->latestPlan()
            ->with('planDetails')
            ->first();

        return response()->json([
            'latest_plan' => $latest_plan,
            'message' => 'Get latest plan'
        ], 200);
    }

    function getCountPlan(Request $request): JsonResponse
    {
        $count_plan = $request
            ->user()
            ->plans()
            ->count();

        return response()->json([
            'count_plan' => $count_plan,
            'message' => 'Get count plan'
        ], 200);
    }

    function upload(Request $request, Plan $plan): JsonResponse
    {
        $file = $request->file('plan');

        $file_name = 'action-plan-' . $request->user()->profile->nis . '-' . $plan->id . '.pdf';
        $file->storePubliclyAs('students/plan', $file_name);

        $plan->update(['pdf' => $file_name]);

        return response()->json([
            'file' => $file_name,
            'message' => 'File uploaded'
        ], 200);
    }
}
