<?php

namespace App\Imports;

use App\Models\Exhibition;
use Maatwebsite\Excel\Concerns\ToModel;

class ExhitionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Exhibition([
            //
        ]);
    }
}
