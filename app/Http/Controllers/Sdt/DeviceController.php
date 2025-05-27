<?php

namespace App\Http\Controllers\Sdt;

use App\Exports\Sdt\DeviceTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\DeviceRequest;
use App\Http\Resources\Sdt\DeviceResource;
use App\Imports\Sdt\UploadDeviceImport;
use App\Models\Sdt\Device;
use App\Models\Sdt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class DeviceController extends Controller
{
    function index(Request $request): JsonResource
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
            ->get();

        return DeviceResource::collection($devices)
            ->additional([
                'message' => 'Get devices',
                'status' => 'success'
            ]);
    }

    function store(DeviceRequest $request): JsonResource
    {
        $device = Device::create($request->all());

        return DeviceResource::make($device)
            ->additional([
                'message' => 'Create device',
                'status' => 'success'
            ]);
    }

    function show(Device $device): JsonResource
    {
        return DeviceResource::make($device)
            ->additional([
                'message' => 'Get device',
                'status' => 'success'
            ]);
    }

    function update(DeviceRequest $request, Device $device)
    {
        $device->update($request->validated());

        return DeviceResource::make($device)
            ->additional([
                'message' => 'Update device',
                'status' => 'success'
            ]);
    }

    function destroy(Device $device): JsonResponse
    {
        $device->delete();

        return response()->json([
            'data' => null,
            'status' => 'success',
            'message' => 'Device deleted'
        ], 200);
    }

    function assign(Request $request, Device $device)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'student_id' => [
                    'required',
                    'sometimes',
                    Rule::exists(Student::class, 'id'),
                ],
            ]
        );

        if ($request->student_id !== null) {
            $validator->after(function ($validator) use ($request, $device) {
                if (
                    Student::find($request->student_id)
                    ->devices()
                    ->where('type', $device->type)
                    ->exists()
                ) {
                    $validator->errors()->add('type', 'Siswa sudah memiliki device dengan tipe yang sama.');
                }
            });
        }

        $validator->validate();

        $device->student_id = $request->student_id ?? null;
        $device->save();

        return DeviceResource::make($device)
            ->additional([
                'message' => 'Assign device',
                'status' => 'success'
            ]);
    }

    function import_template(): JsonResponse
    {
        Excel::store(new DeviceTemplateExport(), 'sdt/template-device.xlsx', 'public');

        $file = Storage::disk('public')->exists('sdt/template-device.xlsx')
            ? url('storage/sdt/template-device.xlsx')
            : null;

        if ($file === null) {
            return response()->json([
                'data' => null,
                'status' => 'error',
                'message' => 'Template device not found'
            ], 404);
        }

        return response()->json([
            'data' => $file,
            'status' => 'success',
            'message' => 'Get template device'
        ], 200);
    }

    function upload(Request $request): JsonResponse
    {
        $import = new UploadDeviceImport();
        $import->import($request->file('file'), 'public', \Maatwebsite\Excel\Excel::XLSX);

        return response()->json([
            'data' => $import->getResult(),
            'status' => 'success',
            'message' => 'Berhasil Upload device'
        ], 200);
    }

    function summary(): JsonResponse
    {
        $devices = Device::withCount(['loans' => function ($query) {
            $query->where('is_returned', 0);
        }])->get();

        $summaries = $devices
            ->groupBy('type')
            ->map(function ($group, $type) {
                return [
                    'type'  => (int) $type,
                    'count' => $group->count(),
                    'loans' => $group->sum('loans_count'),
                ];
            })
            ->values();

        return response()->json([
            'data' => $summaries,
            'message' => 'Get loan summary successfully',
            'status' => 'success'
        ]);
    }
}
