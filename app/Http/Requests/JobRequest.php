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
        if ($this->method() == "PUT") {
            return [
                'title' => 'required|string|max:256|unique:jobs,title,' . $this->jobId,
                'description' => 'required|string|max:1000',
                'status' => 'required|in:opened,closed',
                'workplace' => 'nullable|string|max:1000',
                'salary' => 'nullable|numeric|max:100000000|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
            ];
        }
        return [
            'title' => 'required|string|max:256|unique:jobs',
            'description' => 'required|string|max:1000',
            'status' => 'required|in:opened,closed',
            'workplace' => 'nullable|string|max:1000',
            'salary' => 'nullable|numeric|max:100000000|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        ];
    }
}
