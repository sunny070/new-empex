<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'employeeQualifications.*.certificate' => 'max:2048'
        ];
    }
    public function messages()
    {
        return [
            'employeeQualifications.*.certificate' => 'The document may not be greater than 10 megabytes'
        ];
    }
}
