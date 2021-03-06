<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyFromEditorRequest extends FormRequest
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
        $sender_data = $this->get('sender_data');

        $rules = [
            'sender_data.company' => 'required|string',
            'sender_data.title' => 'string|nullable',
            'sender_data.name' => 'required|string',
            'sender_data.surnames' => 'required|string',
            'sender_data.address_line_1' => 'required|string',
            'sender_data.address_line_2' => 'string|nullable',
            'sender_data.city' => 'required|string',
            'sender_data.country' => 'required|string',
            'sender_data.zip_code' => 'required|string',
            'sender_data.birthday' => 'date_format:Y-m-d|nullable',
        ];

        if($sender_data['is_new']):
          $rules = array_merge($rules, [
            'sender_data.email' => 'required|string|email|max:255|unique:users,email',
            'sender_data.password' => 'string|min:6',
          ]);
        endif;

        return $rules;
    }
}
