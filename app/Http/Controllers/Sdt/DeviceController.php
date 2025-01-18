<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\DeviceRequest;
use App\Models\Sdt\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $devices = Device::with(['rak', 'student'])
            ->when($request->rak)
            ->whereRelation('rak', 'name', $request->rak)
            ->when($request->student)
            ->whereRelation('student', 'name', 'like', '%' . $request->student . '%')
            ->when($request->type)
            ->where('type', $request->type)
            ->when($request->name, function ($query) use ($request) {
                $query
                    ->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('uid', 'like', '%' . $request->uid . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'message' => 'Success',
            'devices' => $devices
        ], 200);
    }

    public function store(DeviceRequest $request): JsonResponse
    {
        $device = Device::create($request->all());
        return response()->json([
            'message' => 'Success',
            'device' => $device
        ], 201);
    }

    public function show(Device $device): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'device' => $device
        ], 200);
    }

    public function update(DeviceRequest $request, Device $device): JsonResponse
    {
        $device->update($request->all());
        return response()->json([
            'message' => 'Success',
            'device' => $device
        ]);
    }

    public function destroy(Device $device): JsonResponse
    {
        return response()->json([
            'message' => $device->delete(),
        ], 200);
    }

    function assign(Request $request, Device $device): JsonResponse
    {
        $request->validate([
            'student_id' => 'required|exists:App\Models\Sdt\Student,id'
        ]);
        $device->student_id = $request->student_id;
        $device->save();

        return response()->json([
            'message' => 'Success',
            'device' => $device
        ], 200);
    }
}
