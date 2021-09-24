<?php

namespace App\Imports;

use App\Models\Exhibition;
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

class ExhibitionsImport implements ToModel, SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $museum = Museum::where('name', $row['place'])->firstOrFail();

        return new Exhibition([
            'museum_uuid' => $museum->uuid,
            'slug' => Str::slug($row['title'], '-'),
            'title' => $row['title'],
            'began_at' => date('Y-m-d', strtotime($row['began_at'])),
            'ended_at' => date('Y-m-d', strtotime($row['ended_at'])),
            'description' => $row['description'],
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
            '*.title' => [
                'required',
                'string',
                'max:255',
            ],
            '*.began_at' => [
                'required',
                'date_format:d/m/Y'
            ],
            '*.ended_at' => [
                'required',
                'date_format:d/m/Y'
            ],
            '*.description' => [
                'required',
                'string'
            ],
            '*.link' => [
                'required',
                'url'
            ],
        ];
    }
}
