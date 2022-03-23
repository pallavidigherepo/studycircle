<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ImportController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file')->store('import');

        //$import = new UsersImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }


        return back()->withStatus('Import in queue, we will send notification after import finished.');
    }
}
