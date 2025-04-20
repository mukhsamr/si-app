<?php

namespace App\Http\Controllers\Santri;

use App\Http\Controllers\Controller;
use App\Http\Requests\Santri\PlanDetailRequest;
use App\Http\Requests\Santri\PlanRequest;
use App\Http\Resources\Santri\PlanListResource;
use App\Http\Resources\Santri\PlanResource;
use App\Models\Santri\Plan;
use App\Models\Santri\PlanDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanController extends Controller
{
    function index(Request $request): JsonResource
    {
        $plans = $request->user()
            ->plans()
            ->latest()
            ->get();

        $plans->transform(function ($plan) {
            $plan->is_editable = $plan->created_at->isToday();
            return $plan;
        });

        return PlanListResource::collection($plans)
            ->additional([
                'message' => 'Get all plans',
                'status' => 'success'
            ]);
    }

    function store(PlanRequest $request): JsonResource
    {
        $plan = $request
            ->user()
            ->plans()
            ->create($request->validated());

        return PlanResource::make($plan)
            ->additional([
                'message' => 'Plan created',
                'status' => 'success'
            ]);
    }

    function show(Plan $plan)
    {
        return PlanResource::make($plan)
            ->additional([
                'message' => 'Get plan',
                'status' => 'success'
            ]);
    }

    function update(Request $request, Plan $plan): JsonResource
    {
        $plan->update([
            'title' => $request->title
        ]);

        return PlanResource::make($plan)
            ->additional([
                'message' => 'Plan updated',
                'status' => 'success'
            ]);
    }

    function updateDetail(PlanDetailRequest $request, Plan $plan): JsonResource
    {
        PlanDetail::updateOrCreate(
            ['plan_id' => $plan->id, 'type' => $request->type],
            ['content' => $request->content]
        );

        return PlanResource::make($plan)
            ->additional([
                'message' => 'Plan detail updated',
                'status' => 'success'
            ]);
    }

    function destroy(Plan $plan): JsonResponse
    {
        $plan->delete();
        return response()->json([
            'data' => null,
            'message' => 'Plan deleted',
            'status' => 'success'
        ], 200);
    }

    function latestPlan(Request $request): JsonResource
    {
        $latest_plan = $request
            ->user()
            ->latestPlan()
            ->first();

        return PlanResource::make($latest_plan)
            ->additional([
                'message' => 'Get latest plan',
                'status' => 'success',
                'meta' => [
                    'count_plan' => $request->user()->plans()->count()
                ]
            ]);
    }

    function upload(Request $request, Plan $plan): JsonResponse
    {
        $file = $request->file('plan');

        $file_name = 'action-plan-' . $request->user()->profile->nis . '-' . $plan->id . '.pdf';
        $file->storePubliclyAs('students/plan', $file_name);

        $plan->update(['pdf' => $file_name]);

        return response()->json([
            'file' => $file_name,
            'message' => 'File uploaded',
            'success' => true
        ], 200);
    }

    function clone(Request $request, Plan $plan)
    {
        $newPlan = $request
            ->user()
            ->plans()
            ->create(['title' => $plan->title]);

        $plan_details =  $plan->planDetails->map(function ($detail) {
            return [
                'type' => $detail->type,
                'content' => $detail->content
            ];
        })->toArray();

        $newPlan->planDetails()->createMany($plan_details);

        return PlanResource::make($newPlan)
            ->additional([
                'message' => 'Plan cloned',
                'status' => 'success'
            ]);
    }
}
