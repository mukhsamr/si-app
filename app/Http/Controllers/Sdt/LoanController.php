<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\LoanRequest;
use App\Models\Sdt\Loan;
use App\Models\Sdt\Student;
use Carbon\CarbonInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index(Request $request): JsonResponse
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
            ->latest()
            ->limit(10)
            ->get();

        $loans->map(function ($loan) {
            $updated = $loan->is_returned ? $loan->updated_at : Carbon::now();
            $loan->time_diff = $loan->created_at->diffForHumans($updated, [
                'join' => ' ',
                'parts' => 2,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ]);
        });

        return response()->json([
            'loans' => $loans,
            'tes' => $request->is_returned
        ], 200);
    }

    public function store(LoanRequest $request): JsonResponse
    {
        $loan = Loan::create($request->all());
        return response()->json([
            'loan' => $loan
        ], 201);
    }

    public function update(Loan $loan): JsonResponse
    {
        $loan->update(['is_returned' => true]);
        return response()->json([
            'loan' => $loan
        ], 200);
    }

    function find(string $uid): JsonResponse
    {
        $student = Student::with([
            'devices',
            'loans' => fn($query) => $query->isNotReturned()
        ])->firstWhere('uid', $uid);

        return response()->json([
            'student' => $student
        ], 200);
    }
}
