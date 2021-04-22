<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruiterRequest extends FormRequest
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
            'name' => 'required|min:3|max:190',
            'email' => 'required|email|min:5|unique:recruiters',
            'password' => 'required',
            'company_id' => 'required|numeric|unique:recruiters||exists:companies,id'
        ];
    }
}
