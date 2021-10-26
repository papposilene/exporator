<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('tags')->delete();
        
        $tagsFile = Storage::disk('install')->get('tags.json');
        $tagsData = json_decode($tagsFile);
        foreach ($countriesData as $data)
        {
            Tag::findOrCreate(
                'tag' => addslashes($data->tag),
                'type' => addslashes($data->type)
            );
        }
    }
}
