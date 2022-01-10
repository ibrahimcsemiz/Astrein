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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $employee = $this->route()->parameter('employee');
        $id = $employee ? $employee->id : $employee;

        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'function' => [
                'required',
                'string'
            ],
            'telephone' => [
                'required',
                'string',
                Rule::unique('contact_information', 'telephone')->ignore($id)
            ],
            'city' => [
                'nullable',
                'string'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'birth_date' => [
                'nullable',
                'date'
            ],
        ];
    }
}
