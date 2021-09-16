<?php

namespace App\Imports;

use App\Models\Museum;
use Maatwebsite\Excel\Concerns\ToModel;

class MuseumsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Museum([
            //
        ]);
    }
}
