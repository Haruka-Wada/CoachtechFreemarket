<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'post_code' => 'required|digits:7',
            'address' => 'required',
            'payment' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => '名前を入力してください',
            'post_code.required' => '配送先の郵便番号は、必ず入力してください',
            'post_code.digits' => '配送先の郵便番号は、7桁の数字で入力してください',
            'address.required' => '配送先の住所は、必ず入力してください',
            'payment.required' => '支払い方法は必ず選択してください'
        ];
    }
}
