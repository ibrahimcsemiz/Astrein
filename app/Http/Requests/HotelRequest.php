<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HotelRequest extends FormRequest
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
        $hotel = $this->route()->parameter('hotel');
        $id = $hotel ? $hotel->id : $hotel;

        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('hotels', 'email')->ignore($id)
            ],
            'telephone' => [
                'required',
                'string',
                Rule::unique('hotels', 'telephone')->ignore($id)
            ],
            'manager_id' => [
                'required',
                'integer'
            ],
            'foreman_id' => [
                'required',
                'integer'
            ],
            'region_id' => [
                'required',
                'integer'
            ],
            'address' => [
                'nullable',
                'string'
            ],
            'city' => [
                'nullable',
                'string'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
        ];
    }
}
