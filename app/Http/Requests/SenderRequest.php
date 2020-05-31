<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SenderRequest extends FormRequest
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
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'Preencha o campo :attribute',
        ];
    }

}
