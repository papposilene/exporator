<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Exhibition extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'start' => $this->began_at,
            'end' => $this->ended_at,
            'description' => $this->description,
            'link' => $this->link,
            'museum' => [
                'uuid' => $this->inPlace->uuid,
                'slug' => $this->inPlace->slug,
                'type' => $this->inPlace->type,
                'name' => $this->inPlace->name,
                'status' => $this->inPlace->status,
                'address' => $this->inPlace->address,
                'city' => $this->inPlace->city,
                'country' => $this->inPlace->cca3,
                'link' => $this->inPlace->link,
                'lat' => $this->inPlace->lat,
                'lon' => $this->inPlace->lon,
            ],
        ];
    }
}
