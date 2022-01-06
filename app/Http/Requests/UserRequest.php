<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['email'] = ',email,' . $this->user->id . ',id';
            $rules['telephone'] = ',telephone,' . $this->user->id . ',id';
        }

        return [
            'name' => 'string|required',
            'email' => 'email|required|unique:users' . $rules['email'],
            'function' => 'string|required',
            'telephone' => 'string|required|unique:contact_information' . $rules['telephone'],
            'city' => 'string|nullable',
            'address' => 'string|nullable',
            'birth_date' => 'date|nullable'
        ];
    }
}
