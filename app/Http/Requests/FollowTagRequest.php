<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag_id' => 'required|bail|integer',
        ];
    }
}