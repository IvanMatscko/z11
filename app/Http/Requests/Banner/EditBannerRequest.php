<?php

namespace App\Http\Requests\Banner;

use App\Banner;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditBannerRequest extends FormRequest
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
            'image_dark'  => 'image|max:5120',
            'image_white' => 'image|max:5120',
            'title'       => 'required|max:100',
            'link'        => 'sometimes|url',
        ];
    }
}
