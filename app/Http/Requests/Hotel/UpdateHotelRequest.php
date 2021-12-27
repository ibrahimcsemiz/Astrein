<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends FormRequest
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
            'email' => 'email|required|unique:hotels,email,' . $this->hotel,
            'telephone' => 'string|required|unique:hotels,telephone,' . $this->hotel,
            'manager_id' => 'integer|required',
            'foreman_id' => 'integer|required',
            'region_id' => 'integer|required',
            'city' => 'string|nullable',
            'address' => 'string|nullable'
        ];
    }
}
