<?php

namespace App\Http\Requests\API;

use App\Traits\ResponseAPI;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class CreateDestinationReview extends FormRequest
{
    use ResponseAPI;
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
            "description" => "required",
            "star" => "required|integer|max:5",
            "destination_id" => "required|exists:destinations,id"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if ($validator->errors()->has('destination_id') && $validator->errors()->get('destination_id')[0] === 'The selected destination id is invalid.') {
            throw new HttpResponseException($this->requestNotfound('Destination not found!'));
        }
        throw new HttpResponseException($this->requestValidation(formatErrorValidatioon($validator->errors()), 'Failed!'));
    }
}
