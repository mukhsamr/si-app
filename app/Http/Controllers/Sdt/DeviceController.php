<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\DeviceRequest;
use App\Models\Sdt\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $devices = Device::with(['rak', 'student'])
            ->when($request->rak_id !== null)
            ->whereRelation('rak', 'id', $request->rak_id)
            ->when($request->type !== null)
            ->where('type', $request->type)
            ->when($request->name !== null)
            ->where(function ($query) use ($request) {
                $query
                    ->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('uid', 'like', '%' . $request->name . '%');
            })
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'devices' => $devices
        ], 200);
    }

    public function store(DeviceRequest $request): JsonResponse
    {
        $device = Device::create($request->all());
        return response()->json([
            'success' => true,
            'device' => $device
        ], 201);
    }

    public function show(Device $device): JsonResponse
    {
        return response()->json([
            'success' => true,
            'device' => $device
        ], 200);
    }

    public function update(DeviceRequest $request, Device $device): JsonResponse
    {
        $device->update($request->all());
        return response()->json([
            'success' => true,
            'device' => $device
        ]);
    }

    public function destroy(Device $device): JsonResponse
    {
        return response()->json([
            'success' => $device->delete(),
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
            'success' => true,
            'device' => $device
        ], 200);
    }

    function templateDevice(): JsonResponse
    {
        $file = Storage::disk('public')->exists('sdt/template-device.csv')
            ? url('storage/sdt/template-device.csv')
            : null;

        return response()->json([
            'success' => true,
            'file' => $file
        ], 200);
    }
}
