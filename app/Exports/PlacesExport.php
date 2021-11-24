<?php

namespace App\Exports;

use App\Models\Place;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlacesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Place::all();
    }

    public function headings(): array
    {
        return [
            'uuid',
            'type',
            'status',
            'name',
            'address',
            'city',
            'country',
            'latitude',
            'longitude',
            'link',
            'twitter',
            'tags',
        ];
    }

    public function map($place): array
    {
        return [
            $place->uuid,
            $place->hasType->type,
            $place->status,
            $place->name,
            $place->address,
            $place->city,
            $place->inCountry->cca3,
            $place->lat,
            $place->lon,
            $place->link,
            $place->twitter,
        ];
    }
}
