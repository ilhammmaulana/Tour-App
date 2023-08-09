<?php

namespace App\Http\Requests\WEB;

use Illuminate\Foundation\Http\FormRequest;

class CreateDestinationRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'longitude' => 'required',
            'latitude' => 'required',
            'description' => 'required|min:5',
            'image' => 'required|mimes:png,jpg,jpeg|max:2024|image',
            'category_id' => 'required',
            'city_id' => 'required',
            'province_id' => 'required',
            'price' => 'required',

        ];
    }
}
