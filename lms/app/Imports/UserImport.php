<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow, WithValidation
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
        $user =  new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'mobile_no'    => $row['mobile_no'],
            'designation'    => $row['designation'],
            'password' => Hash::make(123456789)
        ]);
        return $user->assignRole($row['designation']);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            // Above is alias for as it always validates in batches
            '*.email' => 'required|unique:users',

            // Can also use callback validation rules
            'mobile_no' => 'required',
            '*.mobile_no' => 'required',

            // Can also use callback validation rules
            'designation' => 'required',
            '*.designation' => 'required'
        ];
    }
}
