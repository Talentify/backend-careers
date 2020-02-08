<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Core\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ExampleGetAll extends Request
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
            'per_page' => ['integer', 'max:100'],
            'page' => ['integer'],
            'order_by' => [
                'string',
                Rule::in([
                    'id',
                    'name',
                    'email',
                ]),
            ],
            'direction' => [
                'string',
                Rule::in([
                    'asc',
                    'desc',
                ]),
            ],
            'filters.id' => ['string'],
            'filters.name' => ['string'],
            'filters.email' => ['string'],
        ];
    }
}
