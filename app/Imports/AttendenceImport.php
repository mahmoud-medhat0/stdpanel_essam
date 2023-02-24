<?php

namespace App\Imports;

use App\Models\attend;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AttendenceImport implements ToModel, WithHeadingRow,
SkipsEmptyRows,
SkipsOnError,
SkipsOnFailure,
WithBatchInserts,
WithChunkReading,
WithValidation
{
    use Importable,SkipsErrors,SkipsFailures;
    public function model(array $row)
    {
        return new attend([
            'std_id'  => $row['std_id'],
            'date' => request()->date,
            'attendence' => $row['attendence'],
            'hw'=>$row['hw'],
            'payed'=>$row['payed'],
            'reset'=>$row['reset'],
            'branch_id'=>request()->branch,
            'sec_type_id'=>request()->sec,
            'attend_record'=>session()->get('idrecord')
        ]);
    }
    public function rules(): array
    {
        return [
            '*.std_id'=>['required','exists:students,id'],
            '*.attendence'=>['required','in:0,1,2'],
        ];
    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
