<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filename = $request->fileName;
        $modelName = $request->modelName;

        // This is done to make exports class dynamic and can be used by any ExportClass 
        $exportClass = "App\\Exports\\".$modelName.'Export';
        $class = new $exportClass;

        if ($filename != null) {
            $extensionArray = explode('.', $filename);
            $extension = $extensionArray[1];
            
            if ($extension == "xlsx") {
                return $this->excel->download($class, $filename, Excel::XLSX);
            } 
            if ($extension == "csv") {
                return $this->excel->download($class, $filename, Excel::CSV);
            }
            if ($extension == "pdf") {
                return $this->excel->download($class, $filename, Excel::DOMPDF);
            }
            
        }
    }

}
