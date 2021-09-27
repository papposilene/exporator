<?php

namespace App\Imports;

use App\Models\Exhibition;
use App\Models\Museum;
use Carbon\Carbon;
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
use Spatie\Tags\Tag;

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

        // Is there some tags attached to the exhibition?
        if (isset($row['tags']) && Str::of($row['tags'])->trim()->isNotEmpty())
        {
            // Format : semicolon-separated tags as tag-type:tag-name (ie type:museum of fines arts;type:ecomuseum)
            $tags = Str::of($row['tags'])->split('/,+/');
            foreach ($tags as $tag)
            {
                // Find or create the tag for the exhibition type.
                $tagged[] = Tag::findOrCreate($tag, 'exhibition');
            }
        }

        return new Exhibition([
            'uuid' => (string) Str::uuid(),
            'museum_uuid' => $museum->uuid,
            'slug' => Str::slug($row['title'], '-'),
            'title' => $row['title'],
            'began_at' => Carbon::createFromFormat('d/m/Y', $row['began_at'])->format('Y-m-d'),
            'ended_at' => Carbon::createFromFormat('d/m/Y', $row['ended_at'])->format('Y-m-d'),
            'description' => $row['description'],
            'link' => $row['link'],
            'tags' => $tagged,
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
                'nullable',
                'url'
            ],
        ];
    }
}
