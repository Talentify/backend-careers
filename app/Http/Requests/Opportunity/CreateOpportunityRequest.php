<?php

namespace App\Http\Requests\Opportunity;

use Illuminate\Foundation\Http\FormRequest;

class CreateOpportunityRequest extends FormRequest
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
            'title'       => 'required|max:256',
            'description' => 'required|max:10000',
            'status'      => 'required|in:OPEN,CLOSED,PAUSED',
            'workplace'   => 'max:256',
            'salary'      => 'numeric',
        ];
    }
}
