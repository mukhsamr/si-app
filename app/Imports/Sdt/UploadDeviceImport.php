<?php

namespace App\Imports\Sdt;

use App\Models\Sdt\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UploadDeviceImport implements ToCollection, WithHeadingRow
{
    use Importable;

    protected array $errors = [];
    protected int $success_count = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                $student = Student::find($row['id_siswa']);
                $devices = $student?->devices ?? collect();

                $validator = Validator::make(
                    $row->toArray(),
                    [
                        'id_siswa' => [
                            'required',
                            Rule::exists(Student::class, 'id')
                        ],

                        'uid_laptop' => [
                            'nullable',
                            Rule::unique('devices', 'uid')->ignore(
                                $devices->where('type', 1)->first()?->id
                            ),
                        ],
                        'uid_hp' => [
                            'nullable',
                            Rule::unique('devices', 'uid')->ignore(
                                $devices->where('type', 0)->first()?->id
                            ),
                        ],
                    ],
                    [
                        'id_siswa.required' => 'Kolom ID siswa wajib diisi.',
                        'id_siswa.exists' => 'Siswa dengan ID tersebut tidak ditemukan.',
                        'uid_laptop.unique' => 'UID Laptop ":input" sudah digunakan.',
                        'uid_hp.unique' => 'UID HP ":input" sudah digunakan.',
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

                if ($row['uid_laptop']) {
                    $device = $devices->where('id', $row['id_kaptop'])->first();

                    if ($device) {
                        $device->uid = $row['uid_laptop'];
                        $device->name = $row['nama_laptop'];
                        $device->type = 1;
                        $device->save();
                    }

                    if ($student == null) {
                        $student->devices()->create(
                            [
                                'uid' => $row['uid_laptop'],
                                'name' => $row['nama_laptop'],
                                'type' => 1
                            ]
                        );
                    }
                }

                if ($row['uid_hp']) {
                    $device = $devices->where('id', $row['id_hp'])->first();

                    if ($device) {
                        $device->uid = $row['uid_hp'];
                        $device->name = $row['nama_hp'];
                        $device->type = 0;
                        $device->save();
                    }

                    if ($student == null) {
                        $student->devices()->create(
                            [
                                'uid' => $row['uid_hp'],
                                'name' => $row['nama_hp'],
                                'type' => 0
                            ]
                        );
                    }
                }

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
