<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\RakRequest;
use App\Http\Resources\Sdt\RakResource;
use App\Models\Sdt\Device;
use App\Models\Sdt\Rak;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RakController extends Controller
{
    function index(Request $request): JsonResource
    {
        $raks = Rak::when($request->has('with_devices'))
            ->with('devices.student')
            ->when($request->has('with_count_devices'))
            ->withCount('devices')
            ->get();

        return RakResource::collection($raks)
            ->additional([
                'message' => 'Get raks successfully',
                'status' => 'success'
            ]);
    }

    function store(RakRequest $request): JsonResource
    {
        $rak = Rak::create($request->validated());

        return RakResource::make($rak)
            ->additional([
                'message' => 'Create rak successfully',
                'status' => 'success'
            ]);
    }

    function show(Rak $rak): JsonResource
    {
        return RakResource::make($rak->load('devices'))
            ->additional([
                'message' => 'Get rak successfully',
                'status' => 'success'
            ]);
    }

    function update(RakRequest $request, Rak $rak): JsonResource
    {
        $rak->update($request->validated());

        return RakResource::make($rak)
            ->additional([
                'message' => 'Update rak successfully',
                'status' => 'success',
            ]);
    }

    function destroy(Rak $rak): JsonResponse
    {
        if ($rak->devices()->count() > 0) {
            return response()->json([
                'data' => null,
                'message' => 'Rak has devices',
                'status' => 'error'
            ], 400);
        }

        $rak->delete();
        return response()->json([
            'data' => null,
            'message' => 'Rak deleted successfully',
            'status' => 'success'
        ], 200);
    }

    function assign(Request $request, Rak $rak): JsonResource
    {
        $rak->devices()->update(['rak_id' => null]);
        Device::whereIn('id', $request->device_ids)->update(['rak_id' => $rak->id]);

        return RakResource::make($rak->load('devices'))
            ->additional([
                'message' => 'Assign device to rak successfully',
                'status' => 'success'
            ]);
    }
}
