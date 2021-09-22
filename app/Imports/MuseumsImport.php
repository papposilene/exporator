<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Museum;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class MuseumsImport implements ToModel, SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $slug = Str::slug($row['name'], '-');
        $country = Country::where('cca3', strtolower($row['country']))->firstOrFail();
        $status = ($row['status'] === 'open' ? true : false);

        return new Museum([
            'uuid' => (string) Str::uuid(),
            'slug' => $slug,
            'name' => $row['name'],
            'status' => $status,
            'address' => $row['address'],
            'city' => $row['city'],
            'country_cca3' => $country->cca3,
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
            '*.name' => Rule::unique('museums', 'name'),
            '*.status' => [
                'required',
                'in:open,close'
            ],
            '*.address' => [
                'required',
                'string'
            ],
            '*.city' => [
                'required',
                'string',
                'max:255',
            ],
            '*.country' => [
                'required',
                'string',
                'min:3',
                'max:3',
            ],
            '*.link' => [
                'nullable',
                'url',
            ],
        ];
    }
}
