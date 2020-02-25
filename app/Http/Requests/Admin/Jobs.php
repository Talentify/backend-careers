<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Jobs extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'company' => 'required|min:10|max:256',
            'title' => 'required|min:10|max:256',
            'description' => 'required|min:10|max:10000',
            'status' => 'required|in:active,inactive',
            'workplace' => 'nullable',
            'salary' => 'nullable',
            'contact' => 'required|email'
        ];
    }
}
