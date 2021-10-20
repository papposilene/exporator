<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnfollowExhibitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'follow_uuid' => 'required|bail|uuid',
        ];
    }
}
