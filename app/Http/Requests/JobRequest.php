<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'title'       => 'required|max:250',
            'description' => 'required|max:1000',
            'salary'      => 'required',
            'workplace'   => 'required|max:100',
            'status'      => 'required|in:open,closed',
        ];
    }
}
