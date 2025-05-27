<?php

namespace App\Imports\Sdt;

use App\Models\Sdt\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UploadStudentImport implements ToCollection, WithHeadingRow
{
    use Importable;

    protected array $errors = [];
    protected int $success_count = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {

                $validator = Validator::make(
                    $row->toArray(),
                    [
                        'uid_siswa' => [
                            'sometimes',
                            Rule::unique(Student::class, 'uid')->ignore($row['id_siswa']),
                        ],
                    ],
                    [
                        'uid_siswa.unique' => 'UID Siswa :input sudah digunakan.',
                    ]
                );

                if ($validator->fails()) {
                    $this->errors[] = [
                        'row' => $index + 2,
                        'errors' => $validator->errors()->all(),
                        'values' => $row->toArray(),
                    ];
                    continue;
                }

                Student::where('id', $row['id_siswa'])->update([
                    'uid' => $row['uid_siswa']
                ]);

                $this->success_count++;
            } catch (\Throwable $e) {
                $this->errors[] = [
                    'row' => $index + 2,
                    'errors' => [$e->getMessage()],
                    'values' => $row->toArray(),
                ];
                continue;
            }
        }
    }

    public function getResult(): array
    {
        return [
            'success_count' => $this->success_count,
            'errors' => $this->errors,
        ];
    }
}
