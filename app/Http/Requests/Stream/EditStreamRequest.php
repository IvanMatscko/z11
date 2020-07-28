<?php

namespace App\Http\Requests\Stream;

use App\Stream;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditStreamRequest extends FormRequest
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
            'channel' => 'required|alpha_dash|unique:streams,channel',
            'status' => [
                'required',
                Rule::in([Stream::STREAM_OFF, Stream::STREAM_ON])
            ]
        ];
    }
}
