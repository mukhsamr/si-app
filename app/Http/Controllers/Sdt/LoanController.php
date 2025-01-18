<?php

namespace App\Http\Controllers\Sdt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\LoanRequest;
use App\Models\Sdt\Loan;
use App\Models\Sdt\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoanController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $end_date = Carbon::createFromFormat('Y-m-d', $request->end_date);

        $loans = Loan::with(['device', 'student', 'user'])
            ->when($request->name)
            ->whereRelation('student', 'name', 'like', '%' . $request->name . '%')
            ->when($request->start_date && $request->end_date)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->when($request->rak)
            ->whereRelation('device', 'rak_id', $request->rak)
            ->when($request->type)
            ->whereRelation('device', 'type', $request->type)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'message' => 'Success',
            'loans' => $loans
        ], 200);
    }

    public function store(LoanRequest $request): JsonResponse
    {
        $loan = Loan::create($request->all());
        return response()->json([
            'message' => 'Success',
            'loan' => $loan
        ], 201);
    }

    public function update(Loan $loan): JsonResponse
    {
        $loan->update(['is_returned' => true]);
        return response()->json([
            'message' => 'Success',
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
            'message' => 'Success',
            'student' => $student
        ], 200);
    }
}
