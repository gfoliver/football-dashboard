<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMatch extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'season_id'         => 'required|int',
            'home_team_id'      => 'required|int',
            'away_team_id'      => 'required|int',
            'winner_id'         => 'int|nullable',
            'home_team_goals'   => 'required|int',
            'away_team_goals'   => 'required|int',
            'result'            => 'required|string'
        ];
    }
}
