<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMuseumRequest extends FormRequest
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
            'latitude' => 'required|integer|max:15',
            'longitude' => 'required|integer|max:15',
            'link' => 'nullable|url',
        ];
    }
}
