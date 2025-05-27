<?php

namespace App\Exports\Sdt;

use App\Models\Sdt\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class StudentTemplateExport extends DefaultValueBinder implements FromView, WithCustomValueBinder
{
    public function view(): View
    {
        return view('export.sdt.student-template', [
            'students' => Student::select('id', 'nis', 'name', 'uid')
                ->orderBy('name')
                ->get()
        ]);
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;
    }
}
