<?php

namespace App\Http\Requests;

use App\Models\Card;
use App\Models\Match;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

class MatchFormRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'end_time' => ['required', 'date_format:H:i:s', 'after:start_time'],
            'home_team_id' => ['required', 'integer', 'exists:' . Team::class . ',id'],
            'visitor_team_id' => ['required', 'integer', 'exists:' . Team::class . ',id'],
            'home_team_score' => ['required', 'in:W,L,T'],
            'visitor_team_score' => ['required', 'in:W,L,T'],
        ];
    }
}
