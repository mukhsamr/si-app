<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\LoanRequest;
use App\Http\Resources\Sdt\LoanResource;
use App\Models\Sdt\Device;
use App\Models\Sdt\Loan;
use App\Models\Sdt\Student;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    function index(Request $request): JsonResource
    {
        $start_date = $request->start_date ? Carbon::createFromFormat('Y-m-d', $request->start_date)->format('Y-m-d 00:00:00') : null;
        $end_date = $request->end_date ? Carbon::createFromFormat('Y-m-d', $request->end_date)->format('Y-m-d 23:59:59') : null;

        $loans = Loan::with(['device.rak', 'student'])
            ->withOperator()
            ->when($request->is_returned !== null)
            ->isReturned(boolval($request->is_returned))
            ->when($request->name)
            ->whereRelation('student', 'name', 'like', '%' . $request->name . '%')
            ->when($request->start_date)
            ->where('created_at', '>=', $start_date)
            ->when($request->end_date)
            ->where('created_at', '<=', $end_date)
            ->when($request->rak)
            ->whereRelation('device', 'rak_id', $request->rak)
            ->when($request->type !== null)
            ->whereRelation('device', 'type', $request->type)
            ->latest('updated_at')
            ->limit(100)
            ->get();

        $loans->map(function ($loan) {
            $updated = $loan->is_returned ? $loan->updated_at : Carbon::now();
            $loan->time_diff = $loan->created_at->diffForHumans($updated, [
                'join' => ' ',
                'parts' => 2,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ]);
        });

        return LoanResource::collection($loans)
            ->additional([
                'message' => 'Get loan successfully',
                'status' => 'success'
            ]);
    }

    function store(LoanRequest $request): JsonResource | JsonResponse
    {
        $student = Student::firstWhere('uid', $request->student_uid);
        $device = Device::where('uid', $request->device_uid)
            ->isNotLoaned()
            ->first();

        if ($device === null) {
            return response()->json([
                'error' => ['Device' => 'Device ini sedang dipinjam'],
                'status' => 'error'
            ], 404);
        }

        if ($device->student_id !== $student->id && $device->student_id !== null) {
            return response()->json([
                'error' => ['Device' => 'Device bukan milik siswa ini'],
                'status' => 'error'
            ], 404);
        }

        if ($device->student_id === $student->id || $device->student_id === null) {
            $loan = Loan::create([
                'student_id' => $student->id,
                'device_id' => $device->id,
                'user_id' => $request->user_id
            ]);
        }

        return LoanResource::make($loan)
            ->additional([
                'message' => 'Loan created',
                'status' => 'success'
            ]);
    }

    function update(LoanRequest $request): JsonResource | JsonResponse
    {
        $student = Student::firstWhere('uid', $request->student_uid);
        $device = Device::where('uid', $request->device_uid)
            ->isLoaned()
            ->first();

        if ($device === null) {
            return response()->json([
                'message' => ['Device' => 'Device tidak sedang dipinjam'],
                'status' => 'error'
            ], 404);
        }

        if ($device->student_id !== $student->id) {
            return response()->json([
                'message' => ['Device' => 'Device bukan milik siswa ini'],
                'status' => 'error'
            ], 404);
        }

        if ($device->student_id === $student->id || $device->student_id === null) {
            $loan = Loan::where('device_id', $device->id)->where('is_returned', false)->first();
            $loan->update([
                'is_returned' => true
            ]);
        }

        return LoanResource::make($loan)
            ->additional([
                'message' => 'Loan is returned',
                'status' => 'success'
            ]);
    }

    function find(string $uid): JsonResource
    {
        $student = Student::with([
            'devices',
            'loans' => fn($query) => $query->isNotReturned()
        ])->firstWhere('uid', $uid);

        return LoanResource::make($student)
            ->additional([
                'message' => 'Get loan successfully',
                'status' => 'success'
            ]);
    }
}
