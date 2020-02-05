<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VagasFormRequest extends FormRequest
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
            'titulo' => 'required|min:3',
            'descricao' => 'required|min:10',
            'situacao' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
        ];
    }
}
