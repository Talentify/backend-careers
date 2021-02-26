<?php

namespace App\Http\Requests;

use App\Core\Laravel\FormRequest;
use App\Models\Enums\StatusEnum;
use Illuminate\Validation\Rule;

class JobEntityRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title'       => ['required', 'min:5', 'max:256'],
            'description' => ['required', 'min:5', 'max:1000'],
            'status'      => ['required', Rule::in(StatusEnum::toLabels())],
            'workplace'   => ['string', 'min:3'],
            'salary'     => ['numeric', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':attribute é obrigatório',
            '*.min' => ':attribute deve conter no minimo :min caracteres',
            '*.max' => ':attribute deve conter no máximo :min caracteres',
            'status.in' => 'status informado possui um valor inválido, valores validos (' .implode(',' , StatusEnum::toLabels()). ')',
            'workplace.string' => 'workplace deve ser um texto',
            'salary.numeric' => 'Salário deve ser um numero',
            'salary.gt' => 'Salário se informado, deve ser um numero maior que 0',
        ];
    }
}
