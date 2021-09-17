<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('countries')->delete();

        // Countries https://github.com/mledoze/countries/blob/master/countries.json
        $countriesFile = Storage::disk('install')->get('countries.json');
        $countriesData = json_decode($countriesFile);
        foreach ($countriesData as $data)
        {
            Country::create([
                'name_common_eng'   => addslashes($data->name->common),
                'name_official_eng' => addslashes($data->name->official),
                'name_common_fra'   => addslashes($data->translations->fr->common),
                'name_official_fra' => addslashes($data->translations->fr->official),
                'cca2'              => strtolower($data->cca2),
                'cca3'              => strtolower($data->cca3),
                'region'            => $data->region,
                'subregion'         => $data->subregion,
                'lat'               => $data->latlng[0],
                'lon'               => $data->latlng[1],
                'flag'              => $data->flag,
			]);
        }
    }
}
