<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:190',
            'description' => 'required|max:190',
            'address' => 'required|max:190',
            'salary' => 'numeric',
            'status' => 'required',
            'company_id' => 'required|numeric|exists:companies,id',
            'recruiter_id' => 'required|numeric|exists:recruiters,id'
        ];

        return $rules;
    }
}
