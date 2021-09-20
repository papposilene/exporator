<?php

namespace App\Imports;

use App\Models\Country;
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
        $slug = Str::slug($row['name'], '-');
        $country = Country::where('cca3', strtolower($row['country']))->firstOrFail();

        return new Museum([
            'slug' => $slug,
            'name' => $row['name'],
            'is_open' => (bool) $row['is_open'],
            'address' => $row['address'],
            'city' => $row['city'],
            'country_cca3' => $country,
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
            '*.address' => Rule::in(['string']),
            '*.city' => Rule::in(['string|max:255']),
            //'*.lat' => Rule::in(['digits_between:1,10']),
            //'*.lon' => Rule::in(['digits_between:1,10']),
            '*.link' => Rule::in(['url']),
            '*.country' => Rule::in(['string|min:3|max:3']),
        ];
    }
}
