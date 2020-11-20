<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequestResponse extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                            'success' => false,
                            'message' => 'Invalid data',
                            'code' => 422,
                            'data' => $validator->errors()
                        ],
                422
            )
        );
    }

}
