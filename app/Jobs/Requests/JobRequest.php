<?php

namespace App\Jobs\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class JobRequest
 * @package App\Jobs\Requests
 */
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
        if (!$this->job) {
            return [
                'company_id' => ['required', 'exists:companies,id'],
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'status' => ['required', 'string'],
                'address' => ['required', 'string'],
                'salary' => ['required', 'numeric'],
            ];
        }

        return [
            'company_id' => ['required', 'exists:companies,id'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string'],
            'address' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
        ];
    }
}
