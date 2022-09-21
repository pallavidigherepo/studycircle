<?php

namespace App\Imports;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class EnquiryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Enquiry([
            //
        ]);
    }
}
