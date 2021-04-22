<?php

namespace App\Http\Requests;

use App\Models\Job;
use App\Models\Recruiter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobFormRequest extends FormRequest
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
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:1000'],
            'status' => ['required', Rule::in(['open', 'progress', 'close']),],
            'address' => ['required', 'max:250'],
            'salary' => ['required', 'numeric', 'min:0'],
            'company' => ['required', 'max:60'],
            'recruiter_id' => ['required', 'exists:' . Recruiter::class . ',id']
        ];
    }
}
