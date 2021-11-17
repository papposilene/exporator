<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProposeExhibitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'place' => 'required|bail|uuid',
            'title' => 'required|string|max:255',
            'began_at' => 'required|date_format:d/m/Y',
            'ended_at' => 'required|date_format:d/m/Y',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'price' => 'nullable|numeric',
        ];
    }
}