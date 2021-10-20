<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid' => 'required|bail|uuid',
            'name' => 'required|bail|string|max:255',
        ];
    }
}
