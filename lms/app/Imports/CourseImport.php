<?php

namespace App\Imports;

use App\Models\CoursesType;
use Illuminate\Contracts\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CourseImport implements ToModel, WithHeadingRow, WithValidation
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CoursesType([
            'course_code' => $row['course_code'],
            'name' => $row['name'],
            'language_id' => $row['language_id'],
            //'created_by' => 
        ]);
    }

    public function rules(): array
    {
        return [
            'course_code' => 'required|unique:courses',
            // Above is alias for as it always validates in batches
            '*.course_code' => 'required|unique:courses',

            // Can also use callback validation rules
            'name' => 'required',
            '*.name' => 'required'
        ];
    }
}
