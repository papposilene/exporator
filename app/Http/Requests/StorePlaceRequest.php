<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'cca3' => 'required|string|min:3|max:3',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
            'link' => 'nullable|url',
            'twitter' => 'nullable|string|max:255',
            'image' => 'nullable|image|size:2048',
        ];
    }
}
