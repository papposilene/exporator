<?php

namespace App\Imports;

use App\Models\Exhibition;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ExhitionsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Exhibition([
            'slug' => Str::slug($row['title'], '-'),
            'title' => $row['title'],
            'began_at' => $row['began_at'],
            'ended_at' => $row['ended_at'],
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
            '*.title' => Rule::in(['unique:exhibitions,title']),
            '*.began_at' => Rule::in(['date_format:d/m/Y']),
            '*.ended_at' => Rule::in(['date_format:d/m/Y']),
            '*.link' => Rule::in(['url']),
        ];
    }
}
