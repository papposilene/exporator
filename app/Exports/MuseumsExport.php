<?php

namespace App\Exports;

use App\Models\Museum;
use Maatwebsite\Excel\Concerns\FromCollection;

class MuseumsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Museum::all();
    }
}
