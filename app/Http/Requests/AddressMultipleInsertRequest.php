<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressMultipleInsertRequest extends FormRequest
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
            "addresses" => 'required|array',
            'addresses.*.company' => 'string|nullable',
            'addresses.*.title' => 'string|nullable',
            'addresses.*.name' => 'required|string',
            'addresses.*.surnames' => 'required|string',
            'addresses.*.address_line_1' => 'required|string',
            'addresses.*.address_line_2' => 'string|nullable',
            'addresses.*.city' => 'required|string',
            'addresses.*.country' => 'required|string',
            'addresses.*.birthday' => 'date_format:Y-m-d|nullable',
            // 'addresses.*.zip_code' => 'required|digits_between:5,5|numeric',
            'addresses.*.zip_code' => 'required|numeric', // just for test with invalid zip_code
        ];
    }
}
