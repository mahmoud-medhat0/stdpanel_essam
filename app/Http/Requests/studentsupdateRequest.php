<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentsupdateRequest extends FormRequest
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
            'name'=>['required','max:255'],
            // 'email'=>['required','regex:/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/','max:255'],
            // 'phone'=>['regex:/^01[0-2,5]\d{8}$/'],
            'p_phone'=>['required','regex:/^01[0-2,5]\d{8}$/'],
            'verified'=>['required','in:0,1'],
            'gender' => ['required']
        ];
    }
}
