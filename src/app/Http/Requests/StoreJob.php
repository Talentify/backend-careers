<?php

namespace App\Http\Requests;

use App\Rules\JobStatus;

class StoreJob extends FormRequestResponse
{

    public function __construct()
    {

    }

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
            'title' => 'required|max:255',
            'description' => 'required|max:10000',
            'status' => [
                'required',
                new JobStatus()
            ],
            'workplace' => 'max:255',
            'salary' => 'numeric'
        ];
    }

}
