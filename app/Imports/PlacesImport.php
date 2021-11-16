<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Place;
use App\Models\Type;
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

class PlacesImport implements ToModel, SkipsEmptyRows, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $city = Str::of($row['city'])->trim();
        $name = Str::of($row['name'])->trim();
        $slug = Str::slug($city . ' ' . $name, '-');
        $country = Country::where('cca3', strtolower($row['country']))->firstOrFail();
        $type = Type::firstOrCreate([
                'type' => strtolower($row['type']),
            ],
            [
                'slug' => Str::slug($row['type'], '-'),
            ]);
        $status = ($row['status'] === 'open' ? true : false);

        $place = Place::updateOrCreate([
            'slug' => $slug,
            'name' => $name,
        ],
        [
            'uuid' => (string) Str::uuid(),
            'type' => $type->slug,
            'status' => $status,
            'address' => $row['address'],
            'city' => $city,
            'country_cca3' => $country->cca3,
            'lat' => $row['latitude'],
            'lon' => $row['longitude'],
            'link' => $row['link'],
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

                $tag_type = Str::of($splittag[1])->lower();
                $tag_tag = Str::of($splittag[0])->lower();

                $tagged = Tag::findOrCreate($tag_tag, $tag_type);
                $place->attachTags([$tag_tag], $tag_type);
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
            '*.name' => Rule::unique('places', 'name'),
            '*.type' => [
                'required',
                'in:museum,gallery,library,foundation,art center,art fair,other'
            ],
            '*.status' => [
                'required',
                'in:open,closed'
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
