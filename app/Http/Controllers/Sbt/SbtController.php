<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Models\Santri\User as SantriUser;
use App\Models\Sbt\Student;
use App\Models\Student as AppStudent;
use Illuminate\Http\Request;

class SbtController extends Controller
{
    function index(Request $request)
    {
        $app_student = AppStudent::where('nis', $request->nis)
            ->with(['currentGrades', 'currentPlps'])
            ->first();

        $student = Student::where('nis', $request->nis)
            ->with(['latestNote' => function ($query) {
                $query->withAuthor();
            }])
            ->first();

        $santri_student = SantriUser::whereRelation('profile', 'nis', $request->nis)
            ->with(['latestPlan'])
            ->first();

        return response()->json([
            'data' => [
                'current_grade' => $app_student->currentGrades ?? '',
                'current_plp' => $app_student->currentPlps ?? '',
                'latest_note' => $student->latestNote ?? '',
                'latest_plan' => $santri_student->latestPlan ?? ''
            ],
            'message' => 'Get student',
            'success' => true
        ], 200);
    }
}
