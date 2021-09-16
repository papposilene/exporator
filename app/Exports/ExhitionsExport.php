<?php

namespace App\Exports;

use App\Models\Exhibition;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExhitionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Exhibition::all();
    }
}
