<?php

namespace App\Imports;

use App\Models\Museum;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MuseumsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Museum([
            'slug' => Str::slug($row['name'], '-'),
            'name' => $row['name'],
            'is_open' => $row['is_open'],
            'address' => $row['address'],
            'city' => $row['city'],
            'country_cca3' => $row['country'],
            'lat' => $row['latitude'],
            'lon' => $row['longitude'],
            'link' => $row['link'],

        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.name' => Rule::in(['unique:museums,name']),
            '*.is_open' => Rule::in(['boolean']),
            '*.lat' => Rule::in(['date_format:d/m/Y']),
            '*.lon' => Rule::in(['date_format:d/m/Y']),
            '*.link' => Rule::in(['url']),
            '*.country' => Rule::in(['date_format:d/m/Y']),
        ];
    }
}
