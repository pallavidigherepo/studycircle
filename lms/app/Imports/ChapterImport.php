<?php

namespace App\Imports;

use App\Models\Chapter;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ChapterImport implements ToModel, WithHeadingRow, WithValidation
{

    public function __construct(int $subject)
    {
        $this->parent_id = $subject;
    }

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
        $tags = explode(',', ltrim(rtrim($row['tags'],"]"), "["));
        
        $inputs = [
            'label' => json_encode($row['label']),
            'description' => json_encode($row['description']),
            'parent_id' => $this->parent_id,
            'icon' => $row['icon'],
            'language_id' => $row['language_id'],
            'tags' => $tags,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ];
        $chapter = Chapter::create($inputs);
        
        $chapter->attachTags($tags);
        return $chapter;
    }

    public function rules(): array
    {
        return [
            'label' => 'required|unique:subjects',
            // Above is alias for as it always validates in batches
            '*.label' => 'required|unique:subjects',

            // Can also use callback validation rules
            'description' => 'required',
            '*.description' => 'required'
        ];
    }
}
