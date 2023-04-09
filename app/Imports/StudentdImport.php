<?php

namespace App\Imports;

use Throwable;
use App\Models\students;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingValidation;

class StudentdImport implements
    ToModel,
    WithHeadingRow,
    SkipsEmptyRows,
    SkipsOnError,
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading,
    WithValidation
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['name'] != null) {
            return students::create([
                'name'  => $row['name'],
                'username' => $row['username'],
                'password' => Hash::make($row['password']),
                'phone' => $row['phone'],
                'p_phone' => $row['p_phone'],
                'verified' => $row['verified'],
                'sumprep' => $row['sumprep'],
                'gender' => $row['gender'],
                'sec_type_id' => request()->sec,
            ]);
        }
    }
    public function rules(): array
    {
        return [
            '*.name' => ['required', 'max:100'],
            '*.username' => ['required', 'unique:students,username'],
            '*.password' => ['required', 'min:8'],
            '*.phone' => ['nullable', 'unique:students,phone', 'max:11'],
            '*.p_phone' => ['max:11'],
            '*.verified' => ['required', 'in:0,1'],
            '*.gender' => ['required', 'in:f,m']
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
    public function headingValidation(): bool
    {
        return true;
    }
}
