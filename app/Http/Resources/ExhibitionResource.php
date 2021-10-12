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
            //'began_at' => $this->began_at->format('Y-d-m'),
            //'ended_at' => $this->ended_at->format('Y-d-m'),
            'start' => $this->began_at->format('Y-d-m'),
            'end' => $this->ended_at->format('Y-d-m'),
            'description' => $this->description,
            'link' => $this->link,
            'museum' => [
                'uuid' => $this->inMuseum->uuid,
                'slug' => $this->inMuseum->slug,
                'type' => $this->inMuseum->type,
                'name' => $this->inMuseum->name,
                'status' => $this->inMuseum->status,
                'address' => $this->inMuseum->address,
                'city' => $this->inMuseum->city,
                'country' => $this->inMuseum->inCountry->cca3,
                'link' => $this->inMuseum->link,
                'lat' => $this->inMuseum->lat,
                'lon' => $this->inMuseum->lon,
            ],
        ];
    }
}
