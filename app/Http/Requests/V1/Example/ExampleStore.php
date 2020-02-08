<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Core\Http\Requests\Request;

class ExampleStore extends Request
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
            '' => '',
        ];
    }
}
