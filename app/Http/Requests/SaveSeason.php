<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSeason extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'starts_in' => 'required|unique:seasons',
            'league_id' => 'required',
            'active'    => 'boolean|required',
            'teams'     => 'array|required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'starts_in.unique' => 'This league already has a season starting in this year.',
        ];
    }
}
