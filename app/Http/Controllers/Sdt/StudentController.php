<?php

namespace App\Http\Controllers\Sdt;

use App\Exports\Sdt\StudentTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sdt\StudentRequest;
use App\Http\Resources\Sdt\StudentResource;
use App\Imports\Sdt\UploadStudentImport;
use App\Models\Sdt\Student;
use App\Models\Student as AppStudent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    function index(Request $request): JsonResource
    {
        $students = Student::active()
            ->with('devices')
            ->where('name', 'like', '%' . $request->name . '%')
            ->orderBy('name')
            ->get();

        return StudentResource::collection($students)
            ->additional([
                'message' => 'Get students',
                'status' => 'success'
            ]);
    }

    function show(Request $request, Student $student): JsonResource
    {
        $student->load([
            'devices' => fn($query) => $request->on_loan == 1 ? $query->isNotLoaned() : $query->isLoaned()
        ]);

        return StudentResource::make($student)
            ->additional([
                'message' => 'Get student',
                'status' => 'success',
                'tes' => $request->on_loan
            ]);
    }

    function nameOnly(): JsonResponse
    {
        return response()->json([
            'data' => Student::select('id', 'name')
                ->orderBy('name')
                ->get(),
            'message' => 'Get name only students',
            'status' => 'success'
        ], 200);
    }

    function generate(): JsonResponse
    {
        $app_students = AppStudent::select('id', 'nis', 'name', 'photo', 'gender')->get();

        // Deactivate all student
        Student::where('is_active', 1)->update([
            'is_active' => 0
        ]);

        // Update new student
        foreach ($app_students as $student) {
            Student::updateOrCreate([
                'nis' => $student->nis
            ], [
                'name' => $student->name,
                'photo' => $student->photo,
                'gender' => $student->gender == 'l' ? 1 : 0,
                'is_active' => 1
            ]);
        }

        return response()->json([
            'data' => null,
            'message' => 'Update student',
            'status' => 'success'
        ]);
    }

    function update(StudentRequest $request, Student $student): JsonResponse
    {
        $student->update($request->validated());

        return response()->json([
            'data' => null,
            'message' => 'Update student',
            'status' => 'success'
        ]);
    }

    function import_template(): JsonResponse
    {
        Excel::store(new StudentTemplateExport(), 'sdt/template-student.xlsx', 'public');

        $file = Storage::disk('public')->exists('sdt/template-student.xlsx')
            ? url('storage/sdt/template-student.xlsx')
            : null;

        if ($file === null) {
            return response()->json([
                'data' => null,
                'status' => 'error',
                'message' => 'Template student not found'
            ], 404);
        }

        return response()->json([
            'data' => $file,
            'status' => 'success',
            'message' => 'Get template student'
        ], 200);
    }

    function upload(Request $request): JsonResponse
    {
        $import = new UploadStudentImport();
        $import->import($request->file('file'), 'public', \Maatwebsite\Excel\Excel::XLSX);

        return response()->json([
            'data' => $import->getResult(),
            'status' => 'success',
            'message' => 'Berhasil Upload Siswa'
        ], 200);
    }
}
