<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Position;

use App\Core\Http\Requests\Request;
use App\Models\V1\Position;
use Illuminate\Validation\Rule;

class PositionStore extends Request
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
            'title'       => ['required', 'string', 'max:256'],
            'description' => ['required', 'string', 'max:1000'],
            'status'      => [
                'required', 'integer', Rule::in([
                    Position::CREATED,
                    Position::INTERVIEWING,
                    Position::CONCLUDED,
                    Position::CANCELLED,
                ]),
            ],
            'workplace'   => ['string', 'max:256'],
            'salary'      => ['numeric'],
        ];
    }
}
