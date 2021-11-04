<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishExhibitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'exhibition' => 'required|bail|uuid',
        ];
    }
}
