<?php

namespace App\Exports;

use App\Models\Exhibition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExhibitionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Exhibition::all();
    }

    public function headings(): array
    {
        return [
            'uuid',
            'place',
            'title',
            'began_at',
            'ended_at',
            'price',
            'description',
            'link',
            'tags',
        ];
    }

    public function map($exhibition): array
    {
        return [
            $exhibition->uuid,
            $exhibition->inPlace->name,
            $exhibition->title,
            $exhibition->began_at->format('d/m/Y'),
            $exhibition->ended_at->format('d/m/Y'),
            $exhibition->price,
            $exhibition->description,
            $exhibition->link,
            $exhibition->isTagged(),
        ];
    }
}
