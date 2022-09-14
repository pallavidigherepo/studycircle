<?php

namespace App\Imports;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Date;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
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
     * @throws \Exception
     */
    public function model(array $row)
    {
        $input = [
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make(123456789),
            'aadhaar' => $row['aadhaar'],
            'mobile' => $row['mobile'],
            'alt_mobile' => $row['alternate_mobile'],
            'gender' => $row['gender'],
            'dob' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])),
            'permanent_address' => $row['permanent_address'],
            'address' => $row['address'],
            'mother_name' => $row['mother_name'],
            'mother_email' => $row['mother_email'],
            'mother_mobile' => $row['mother_mobile'],
            'mother_qualification' => $row['mother_qualification'],
            'mother_occupation' => $row['mother_occupation'],
            'father_name' => $row['father_name'],
            'father_email' => $row['father_email'],
            'father_mobile' => $row['father_mobile'],
            'father_qualification' => $row['father_qualification'],
            'father_occupation' => $row['father_occupation'],
            'parent_email' => $row['parent_email'],
            'parent_password' => Hash::make(123456789),
            'board_id' => $row['board'],
            'standard_id' => $row['standard'],
            'language_id' => $row['language'],
            'course_id' => $row['course'],
        ];
        $student = Student::create($input);
        $student->roll_number = generate_student_roll_number();
        $student->save();
        return $student;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:students',
            '*.email' => 'required|unique:students',
            'mobile' => 'required',
            '*.mobile' => 'required',
        ];
    }
}
