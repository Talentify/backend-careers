<?php

namespace App\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CompanyRequest
 * @package App\Companies\Requests
 */
class CompanyRequest extends FormRequest
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
        if (!$this->company) {
            return [
                'company' => ['required', 'string'],
                'about' => ['nullable', 'string'],
                'link' => ['nullable', 'string'],
            ];
        }

        return [
            'company' => ['required', 'string'],
            'about' => ['nullable', 'string'],
            'link' => ['nullable', 'string'],
        ];
    }
}
