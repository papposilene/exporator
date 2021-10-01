<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'museum',
            'gallery',
            'library',
            'foundation',
            'art center',
            'art fair',
            'other'
        ];

        // Drop the table
        DB::table('museums_types')->delete();

        foreach ($types as $data)
        {
            Type::create([
                'type' => $data,
                'slug' => Str::slug($data, '-'),
			]);
        }
    }
}
