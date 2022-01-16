<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $calculationMethod = $this->route()->parameter('calculation-methods');
        $id = $calculationMethod ? $calculationMethod->id : $calculationMethod;

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('calculation_methods', 'name')->ignore($id)
            ],
            'calculation_per_minute' => [
                'required',
                'integer',
            ],
        ];
    }
}
