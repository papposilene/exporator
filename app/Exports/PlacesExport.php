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
            'name',
            'address',
            'city',
            'country',
            'latitude',
            'longitude',
            'link',
            'tags',
        ];
    }

    public function map($place): array
    {
        return [
            $place->uuid,
            $place->hasType->type,
            $place->name,
            $place->address,
            $place->city,
            $place->inCountry->cca3,
            $place->latitude,
            $place->longitude,
            $place->link,
        ];
    }
}
