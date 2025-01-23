<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'post_code' => 'required|digits:7',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => '名前を入力してください',
            'post_code.required' => '郵便番号は、必ず入力してください',
            'post_code.digits' => '7桁の数字で入力してください',
            'address.required' => '住所は、必ず入力してください',
        ];
    }
}
