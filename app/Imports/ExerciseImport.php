<?php

namespace App\Imports;

use App\Models\exercise;
use Maatwebsite\Excel\Concerns\ToModel;

class ExerciseImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['std_id'] != null) {
            return new exercise([
                'std_id'  => $row['std_id'],
                'date' => request()->date,
                'degree' => $row['degree'],
                'branch_id' => request()->branch,
                'sec_type_id' => request()->sec,
                'Exercise_Record' => session()->get('idrecord')
            ]);
        }
    }
}
