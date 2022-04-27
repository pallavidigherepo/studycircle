<?php

namespace App\Exports;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubjectExport implements 
                    WithMapping,
                    Responsable, 
                    ShouldAutoSize, 
                    WithHeadings, 
                    WithEvents,
                    FromCollection

{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SubjectResource::collection(Subject::all());
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function query()
    {
        return Course::query();
    }*/

    public function map($subject): array 
    {
        return [
            $subject->id,
            json_decode($subject->label),
            json_decode($subject->description),
            $subject->icon,
            $subject->tags->pluck('name'),
            $subject->language_id,
            $subject->created_at,
        ];
    }

    public function headings(): array {
        return [
            '#',
            'Label',
            'Description',
            'Icon',
            'Tags',
            'Language Id',
            'Created At'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font'=> [
                        'bold' => true,
                    ],
                    /*'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ]*/
                ]);
            }
        ];
    }
}