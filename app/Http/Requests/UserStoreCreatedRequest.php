<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserStoreCreatedRequest extends FormRequest
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
            // 'name' => "required|min:3|max:50|unique:categories,name,id,{$this->segment(3)},id"
            "name" => "required|min:5|max:80",
            'email' => "required|email",
            'username' => "required|min:3|max:50|".Rule::unique('users')->ignore($this->id, 'id'),
            'password' => "required|min:6|max:20",
            'company' => "required|exitis:company,id"
        ];
    }
}
