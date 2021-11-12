<?php

namespace App\Imports;

use App\Models\Exhibition;
use App\Models\Place;
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
        $place = Place::where('name', $row['place'])->firstOrFail();

        $exhibition = Exhibition::updateOrCreate([
            'slug' => Str::slug($row['title'], '-'),
            'title' => $row['title'],
        ],
        [
            'uuid' => (string) Str::uuid(),
            'place_uuid' => $place->uuid,
            'began_at' => Carbon::createFromFormat('d/m/Y', $row['began_at'])->format('Y-m-d'),
            'ended_at' => Carbon::createFromFormat('d/m/Y', $row['ended_at'])->format('Y-m-d'),
            'description' => $row['description'],
            'link' => $row['link'],
            'price' => $row['price'],
            'is_published' => true,
        ]);

        // Is there some tags attached to the exhibition?
        if (isset($row['tags']) && Str::of($row['tags'])->trim()->isNotEmpty())
        {
            // Format : semicolon-separated tags as tag-type:tag-name (ie type:museum of fines arts;type:ecomuseum)
            $tags = Str::of($row['tags'])->split('/,+/');
            foreach ($tags as $tag)
            {
                if (empty($tag)) continue;

                // Find or create the tag for the exhibition type.
                $splittag = Str::of($tag)->split('/:+/');

                $tag_type = Str::of($splittag[0])->lower();
                $tag_tag = Str::of($splittag[1])->lower();

                $tagged = Tag::findOrCreate($tag_tag, $tag_type);
                $exhibition->attachTags([$tag_tag], $tag_type);
            }
        }
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
            '*.price' => [
                'nullable',
                'numeric'
            ],
        ];
    }
}
