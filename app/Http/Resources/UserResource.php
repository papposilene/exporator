<?php

namespace App\Http\Resources;

use App\Http\Resources\ExhibitionResource;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'since' => $this->created_at,
            'places' => PlaceResource::collection($this->followedPlaces),
            'exhibitions' => ExhibitionResource::collection($this->followedExhibitions),
            'tags' => TagResource::collection($this->followedTags),
        ];
    }
}
