<?php

namespace App\Imports;

use App\Models\Chapter;
use Maatwebsite\Excel\Concerns\ToModel;

class ChapterImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Chapter([
            //
        ]);
    }
}
