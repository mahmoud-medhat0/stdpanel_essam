<?php

namespace App\Imports;

use App\Models\students;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class StudentdImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['name'] != null) {
            return new students([
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
}
