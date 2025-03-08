<?php

namespace App\Http\Controllers\Sbt;

use App\Http\Controllers\Controller;
use App\Http\Resources\Sbt\StudentListResource;
use App\Http\Resources\Sbt\StudentNoteResource;
use App\Http\Resources\Sbt\StudentPlanResource;
use App\Http\Resources\Sbt\StudentResource;
use App\Http\Resources\StudentFamilyResource;
use App\Models\Sbt\Student;
use App\Models\Student as AppStudent;
use App\Models\Santri\User as SantriUser;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentController extends Controller
{
    function index()
    {
        $students = AppStudent::select('id', 'nis', 'name', 'nickname', 'photo', 'birth_date')
            ->with('currentGrades')
            ->orderBy('name')
            ->get();

        return StudentResource::collection($students)
            ->additional([
                'message' => 'Get all students',
                'status' => 'success'
            ]);
    }

    function list(): JsonResource
    {
        $students = Student::select('id', 'nis', 'name', 'nickname', 'photo', 'birth_date')
            ->orderBy('name')
            ->get();

        return StudentListResource::collection($students)
            ->additional([
                'message' => 'Get list students',
                'status' => 'success'
            ]);
    }

    function show(AppStudent $student): JsonResource
    {
        return StudentFamilyResource::make($student->load('family'))
            ->additional([
                'message' => 'Get student',
                'status' => 'success'
            ]);
    }

    function notes(Student $student): JsonResource
    {
        $notes = $student->notes()->withAuthor()->latest()->get();
        return StudentNoteResource::collection($notes)
            ->additional([
                'message' => 'Get student notes',
                'status' => 'success'
            ]);
    }

    function latestNote(Student $student): JsonResource
    {
        $student = $student->latestNote()->withAuthor()->latest()->first();
        return StudentNoteResource::make($student)
            ->additional([
                'message' => 'Get latest note',
                'status' => 'success'
            ]);
    }

    function plans(Student $student): JsonResource
    {
        $student = SantriUser::whereRelation('profile', 'nis', $student->nis)->first();
        return StudentPlanResource::collection($student->plans()->latest()->get())
            ->additional([
                'message' => 'Get plans',
                'status' => 'success'
            ]);
    }

    function plan(Student $student, string $planId): JsonResource
    {
        $student = SantriUser::whereRelation('profile', 'nis', $student->nis)->first();
        return StudentPlanResource::make($student->plans()->with('planDetails')->find($planId))
            ->additional([
                'message' => 'Get plan',
                'status' => 'success'
            ]);
    }

    function latestPlan(Student $student): JsonResource
    {
        $student = SantriUser::whereRelation('profile', 'nis', $student->nis)->first();
        $plan = $student->latestPlan()->first();

        return StudentPlanResource::make($plan)
            ->additional([
                'message' => 'Get plan',
                'status' => 'success',
                'meta' => [
                    'count_plan' => $student->plans()->count()
                ]
            ]);
    }
}
