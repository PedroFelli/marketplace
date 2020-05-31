<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{

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
            'input[name=card_name]' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Preencha o campo :attribute',
        ];
    }

}
