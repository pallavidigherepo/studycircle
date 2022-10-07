<?php

namespace App\Exports;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use phpDocumentor\Reflection\Types\Void_;

class StudentExport implements
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
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->isDemo) {
            return Student::factory()->count(1)->make();
        }
        return StudentResource::collection(Student::all());
    }

    public function map($student): array
    {
        if ($this->isDemo) {
            return array();
        }
        return [
            $student->id,
            $student->name,
            $student->board->name,
            $student->standard->name,
            $student->course_id,
            $student->batch_id,
            $student->language_id,
            $student->email,
            $student->mobile,
            $student->alt_mobile,
            $student->gender,
            $student->dob,
            $student->permanent_address,
            $student->address,
            $student->mother_name,
            $student->mother_email,
            $student->mother_mobile,
            $student->mother_qualification,
            $student->mother_occupation,
            $student->father_name,
            $student->father_email,
            $student->father_mobile,
            $student->father_qualification,
            $student->father_occupation,
            $student->parent_email,
            $student->created_at,
        ];
    }

    public function headings(): array {
        if ($this->isDemo) {
            return [
                'Name',
                'Board',
                'Standard',
                'Course',
                'Batch',
                'Language',
                'Email',
                'Aadhaar',
                'Mobile',
                'Alternate Mobile',
                'Gender',
                'Date of Birth',
                'Permanent Address',
                'Address',
                'Mother Name',
                'Mother Email',
                'Mother Mobile',
                'Mother Qualification',
                'Mother Occupation',
                'Father Name',
                'Father Email',
                'Father Mobile',
                'Father Qualification',
                'Father Occupation',
                'Parent Email',
            ];
        }
        return [
            '#',
            'Name',
            'Board',
            'Standard',
            'Course',
            'Batch',
            'Language',
            'Email',
            'Mobile',
            'Alternate Mobile',
            'Gender',
            'Date of Birth',
            'Permanent Address',
            'Address',
            'Mother Name',
            'Mother Email',
            'Mother Mobile',
            'Mother Qualification',
            'Mother Occupation',
            'Father Name',
            'Father Email',
            'Father Mobile',
            'Father Qualification',
            'Father Occupation',
            'Parent Email',
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
