<?php

namespace App\Http\Requests\Jobs\Search;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
            'keywords' => 'string|nullable',
            'addressState' => 'string|nullable',
            'addressCity' => 'string|nullable',
            'addressCountry' => 'string|nullable',
            'salaryStart' => 'numeric|required_with:salaryEnd',
            'salaryEnd' => 'numeric|required_with:salaryStart',
            'company' => 'string|nullable'
        ];
    }
}
