<?php

namespace App\Imports;

use Exception;
use App\Models\exams;
use App\Models\ExamRecords;
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

class ExamsImport implements
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

    public $idrecord;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function __construct()
    {
        $this->idrecord = ExamRecords::latest('created_at')->get()[0]->id;
    }
    public function model(array $row)
    {
        if ($row['std_id'] != null) {
            try {
                return exams::create([
                    'std_id'  => $row['std_id'],
                    'date' => request()->date,
                    'payed' => $row['payed'],
                    'degree' => $row['degree']!=null ? $row['degree'] : "*",
                    'branch_id' => request()->branch,
                    'sec_type_id' => request()->sec,
                    'attend_record' => $this->idrecord
                ]);
            } catch (Exception $th) {
                dd($th);
            }
        }
    }
    public function rules(): array
    {
        return [
            '*.std_id'=>['required','exists:students,id'],
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
