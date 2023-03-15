<?php

namespace App\Exports;

use App\Http\Resources\FeeStructureResource;
use App\Models\FeeStructure;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class FeeStructureExport implements
    WithMapping,
    Responsable,
    ShouldAutoSize,
    WithHeadings,
    WithEvents,
    FromCollection
{
    use Exportable;

    /**
     * @var bool
     */
    private $isDemo;

    /**
     * @param int $question
     * @param bool $demo
     */
    public function __construct(bool $demo = false)
    {
        $this->isDemo = $demo;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collection()
    {
        if ($this->isDemo) {
            return FeeStructure::factory()->count(1)->make();
        }
        return FeeStructureResource::collection(FeeStructure::all());
    }


    public function map($row): array
    {
        if ($this->isDemo) {
            return array();
        }
        return [
            $row->id,
            $row->standard->name,
            $row->batch->name,
            $row->fee_type->name,
            $row->fee_category->name,
            $row->amount,
            $row->created_at,
        ];
    }

    public function headings(): array {
        if ($this->isDemo) {
            return [
                'Standard',
                'Batch',
                'Fee Type',
                'Fee Category',
                'Amount',
            ];
        }
        return [
            '#',
            'Standard',
            'Batch',
            'Fee Type',
            'Fee Category',
            'Amount',
            'Created At'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
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
