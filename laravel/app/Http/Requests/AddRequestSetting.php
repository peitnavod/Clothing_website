<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestSetting extends FormRequest
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
            'config_key' => 'required|unique:settings|max:255',
            'config_value'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'config_key.required' => 'Key khong duoc de trong',
            'config_value.required'=> 'Value khong duoc de trong'
        ];
    }
}
