<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'region' => $this->region,
            'subregion' => $this->subregion,
            'cca2' => $this->cca2,
            'cca3' => $this->cca3,
            'name_common' => [
                'eng' => $this->name_common_eng,
                'fra' => $this->name_common_fra,
            ],
            'name_official' => [
                'eng' => $this->name_official_eng,
                'fra' => $this->name_official_fra,
            ],
            'geoloc' => [
                'lat' => $this->lat,
                'lon' => $this->lon,
            ],
            'flag' => $this->flag,
        ];
    }
}
