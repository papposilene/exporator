<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExhibitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'start' => $this->began_at->format('Y-d-m'),
            'end' => $this->ended_at->format('Y-d-m'),
            'description' => $this->description,
            'price' => $this->price,
            'link' => $this->link,
            'place' => [
                'uuid' => $this->inPlace->uuid,
                'slug' => $this->inPlace->slug,
                'type' => $this->inPlace->type,
                'name' => $this->inPlace->name,
                'status' => $this->inPlace->status,
                'address' => $this->inPlace->address,
                'city' => $this->inPlace->city,
                'country' => $this->inPlace->inCountry->cca3,
                'link' => $this->inPlace->link,
                'lat' => $this->inPlace->lat,
                'lon' => $this->inPlace->lon,
            ],
        ];
    }
}
