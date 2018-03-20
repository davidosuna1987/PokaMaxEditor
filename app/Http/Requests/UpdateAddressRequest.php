<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company' => 'string|nullable',
            'title' => 'string|nullable',
            'name' => 'required|string',
            'surnames' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'string|nullable',
            'city' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|string',
            'birthday' => 'date_format:Y-m-d|nullable'
        ];
    }
}
