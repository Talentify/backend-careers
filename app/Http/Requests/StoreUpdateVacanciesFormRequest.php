<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateVacanciesFormRequest extends FormRequest
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
            'title'         => "required|min:3|max:100|".Rule::unique('vacancies')->ignore($this->id, 'id'),
            'status'        => 'required|max:20',
            'address'       => 'required|max: 100',
            'salary'        => 'required',
            'keyword'        => 'required',
        ];
    }
}
