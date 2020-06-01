<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required| min:20',
            'price' => 'required',
            'body' => 'required',
            'colors' => 'required',
            'photos.*' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Este campo :attribute é obrigatorio',
            'min' => 'Campo deve ter no mínimo :min caracteres',
            'image' => 'Arquivo não é uma imagem válida',
        ];
    }
}
