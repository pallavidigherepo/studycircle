<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

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
     */
    public function model(array $row)
    {
        $student =  new Student([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make(123456789),
            'mobile' => $row['mobile'],
            'alt_mobile' => $row['alt_mobile'],
            'gender' => $row['gender'],
            'avatar' => $row['avatar'],
            'dob' => $row['dob'],
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
            'board_id' => $row['board_id'],
            'standard_id' => $row['standard_id'],
            'language_id' => $row['language_id'],
            'course_id' => $row['course_id'],
            
            //$table->string('roll_number')->unique();
        ]);
        return Student::create($student);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:students',
            // Above is alias for as it always validates in batches
            '*.email' => 'required|unique:students',

            // Can also use callback validation rules
            'mobile' => 'required',
            '*.mobile' => 'required',
        ];
    }
}
