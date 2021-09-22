<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMuseumRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'boolean',
            'address' => 'required|text',
            'city' => 'required|string|max:255',
            'country' => 'required|string|min:3|max:3',
            'latitude' => 'required|integer|max:14',
            'longitude' => 'required|integer|max:14',
            'link' => 'nullable|url',
        ];
    }
}
