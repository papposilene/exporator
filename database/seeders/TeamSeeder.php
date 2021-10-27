<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop the table
        DB::table('teams')->delete();

        Team::create([
          'name' => 'Administration',
          'personal_team' => false,
        ]);
      
        Team::create([
          'name' => 'Users',
          'personal_team' => false,
        ]);
    }
}
