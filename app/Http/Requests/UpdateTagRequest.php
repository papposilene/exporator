<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|bail|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ];
    }
}
