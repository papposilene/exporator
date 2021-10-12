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
                'uuid' => $this->inMuseum->uuid,
                'slug' => $this->inMuseum->slug,
                'type' => $this->inMuseum->type,
                'name' => $this->inMuseum->name,
                'status' => $this->inMuseum->status,
                'address' => $this->inMuseum->address,
                'city' => $this->inMuseum->city,
                'country' => $this->inMuseum->cca3,
                'link' => $this->inMuseum->link,
                'lat' => $this->inMuseum->lat,
                'lon' => $this->inMuseum->lon,
            ],
        ];
    }
}
