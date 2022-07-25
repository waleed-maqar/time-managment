<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class taskRequest extends FormRequest
{
    public $validator = null;
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
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
     * @return array
     */
    public function rules(Request $request)
    {
        $timeAfter = $request['start_date'] == $request['end_date'] ? '|after:' . $request['start_time'] : '';
        return [
            'title' => 'required|max:60',
            'description' => 'required|max:250',
            'periority' => 'required|in:normal,high,low',
            'start_date' => 'required|',
            'start_time' => 'required',
            'end_date' => 'required|after_or_equal:' . $request['start_date'],
            'end_time' => 'required' . $timeAfter
        ];
    }
}