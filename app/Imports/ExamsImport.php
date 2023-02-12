<?php

namespace App\Imports;

use App\Models\exams;
use Maatwebsite\Excel\Concerns\ToModel;

class ExamsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['std_id']) {
            return new exams([
                'std_id'  => $row['std_id'],
                'date' => request()->date,
                'payed' => $row['payed'],
                'degree' => $row['degree'],
                'branch_id' => request()->branch,
                'sec_type_id' => request()->sec,
                'attend_record' => session()->get('idrecord')
            ]);
        }
    }
}
