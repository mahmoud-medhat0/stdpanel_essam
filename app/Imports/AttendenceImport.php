<?php

namespace App\Imports;

use App\Models\attend;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendenceImport implements ToModel, WithHeadingRow
{
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
}
