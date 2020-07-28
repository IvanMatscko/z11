<?php

namespace App\Http\Requests\Player;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlayerRequest extends FormRequest
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
            'account_id'  => 'required|numeric',
            'player_name' => 'required|alpha_dash',
            'age'         => 'required|numeric',
            'position'    => 'required|numeric',
            'team_id'     => 'required|numeric',
            'player_logo' => 'sometimes|image|max:2048',
        ];
    }
}
