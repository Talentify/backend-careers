<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class JobsRequest extends FormRequest
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

    public function prepareForValidation()
    {
        if (!is_null($this->status)) {
            $this->merge([
                'status' => Str::slug($this->status)
            ]);
        }

        if (!is_null($this->id)) {
            $this->merge([
                'id' => Str::slug($this->id),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $requestMethod = $this->getMethod();

        $rules = [
            'job.title'       => 'required|min:5|max:256',
            'job.description' => 'required|min:5|max:10000',
            'job.workplace'   => 'min:5|max:256',
            'job.status'      => [
                'required',
                Rule::in(['opened', 'closed', 'paused'])
            ],
            'job.salary'      => 'numeric'
        ];

        if ($requestMethod === 'PUT') {
            $rules['id'] = 'required|exists:jobs';
        }

        if ($requestMethod === 'GET') {
            $rules = [
                'status' => Rule::in(['opened', 'closed', 'paused']),
                'id'     => 'exists:jobs'
            ];
        }

        if ($requestMethod === 'DELETE') {
            $rules = [
                'id' => 'required|exists:jobs'
            ];
        }

        return $rules;
    }
}
