<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class examstore extends FormRequest
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
        // $r = array_keys($this->except('_token'));
        // $degrees = array();
        // $id = array();
        // for ($i = 0; $i < count($r); $i++) {
        //     $a = explode("_", strval($r[$i]));
        //     if ($a[0] == "id") {
        //         array_push($id, $r[$i]);
        //     }
        //     if ($a[0] == "degree") {
        //         array_push($degrees, $r[$i]);
        //     }
        // }
        // for ($i = 0; $i < count($r); $i++) {
        
        // }
        return [
            'date' => ['required', 'date'],
        ];
    }
}
