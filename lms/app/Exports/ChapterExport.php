<?php

namespace App\Exports;

use App\Models\Chapter;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChapterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Chapter::all();
    }
}
