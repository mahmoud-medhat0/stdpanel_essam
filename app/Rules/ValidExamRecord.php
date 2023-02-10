<?php

namespace App\Rules;

use App\Models\ExamRecords;
use Illuminate\Contracts\Validation\Rule;

class ValidExamRecord implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $records = ExamRecords::all();
        foreach ($records as $record) {
            if ($record->id==$value) {
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Id Exam Record Not Valid.';
    }
}
