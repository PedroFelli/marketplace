<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardAddRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'color' => 'required',
            'size' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Selecione uma opção',
        ];
    }
}
