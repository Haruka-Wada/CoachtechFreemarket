<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellRequest extends FormRequest
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
    public function rules() {

        return [
            'category_ids' => 'required',
            'condition_id' => 'required',
            'name' => 'required',
            'image' => 'required|file|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'price' => 'required|integer',
            'description' => 'required'
        ];
    }

    public function messages() {

        return [
            'category_ids.required' => 'カテゴリーを選んでください',
            'condition_id.required' => '商品の状態を選んでください',
            'name.required' => '商品名を入力してください',
            'image.required' => '商品の画像を選択してください',
            'image.file' => 'ファイルを指定してください',
            'image.mimes' => 'jpeg,jpg,pngを指定してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格は数字で入力してください',
            'description.required' => '商品の説明を入力してください'
        ];
    }
}
