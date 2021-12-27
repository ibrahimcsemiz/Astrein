<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email,' . $this->user,
            'function' => 'string|required',
            'telephone' => 'string|required|unique:contact_information,telephone,' . $this->user . ',user_id',
            'city' => 'string|nullable',
            'address' => 'string|nullable',
            'birth_date' => 'date|nullable'
        ];
    }
}
