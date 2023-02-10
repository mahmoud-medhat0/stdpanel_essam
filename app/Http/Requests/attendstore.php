<?php

namespace App\Http\Requests;

use App\Rules\ValidBranch;
use App\Rules\ValidSecType;
use Illuminate\Foundation\Http\FormRequest;

class attendstore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'branche'=>['required',new ValidBranch],
            'sec'=>['required',new ValidSecType],
            'date'=>['required','date']
        ];
    }
}
