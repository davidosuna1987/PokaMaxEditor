<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostcardRequest extends FormRequest
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
            'product_name' => 'required|string|in:standard,horizontal,vertical',
            // 'front_cropped_file_path' => 'required|active_url',
            // 'front_original_file_path' => 'required|active_url',
            'back_text' => 'required|string',
            'font_data.font_family' => 'required|integer',
            'font_data.font_size' => 'required|integer',

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

            // 'reciever_data.company' => 'string|nullable',
            // 'reciever_data.title' => 'string|nullable',
            // 'reciever_data.name' => 'required|string',
            // 'reciever_data.surnames' => 'required|string',
            // 'reciever_data.address_line_1' => 'required|string',
            // 'reciever_data.address_line_2' => 'string|nullable',
            // 'reciever_data.city' => 'required|string',
            // 'reciever_data.country' => 'required|string',
            // 'reciever_data.zip_code' => 'required|string',
            // 'reciever_data.birthday' => 'date_format:Y-m-d|nullable'

            'reciever_data' => 'required|array',
            'reciever_data.*.company' => 'string|nullable',
            'reciever_data.*.title' => 'string|nullable',
            'reciever_data.*.name' => 'required|string',
            'reciever_data.*.surnames' => 'required|string',
            'reciever_data.*.address_line_1' => 'required|string',
            'reciever_data.*.address_line_2' => 'string|nullable',
            'reciever_data.*.city' => 'required|string',
            'reciever_data.*.country' => 'required|string',
            'reciever_data.*.zip_code' => 'required|string',
            'reciever_data.*.birthday' => 'date_format:Y-m-d|nullable'
        ];
    }
}
