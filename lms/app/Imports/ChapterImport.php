<?php

namespace App\Imports;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChapterImport implements ToCollection, WithHeadingRow
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


    public function collection(Collection $rows)
    {
         Validator::make($rows->toArray(), [
            '*.label' => 'required|unique:subjects',
            //'label' => 'required|unique:subjects',
            // Above is alias for as it always validates in batches
            //'*.label' => 'required|unique:subjects',

            // Can also use callback validation rules
            //'description' => 'required',
            '*.description' => 'required'
         ])->validate();
        $subject = Subject::findOrFail($this->parent_id);
        foreach ($rows as $row) {
            $tags = explode(',', $row['tags']);
            $inputs = [
                'label' => json_encode($row['label']),
                'description' => json_encode($row['description']),
                'board_id' => $subject->board_id,
                'standard_id' => $subject->standard_id,
                'parent_id' => $this->parent_id,
                'icon' => $row['icon'],
                'language_id' => $row['language_id'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            $chapter = Chapter::create($inputs);
            if (!empty($tags)) {
                $chapter->detachTags($tags);
                $chapter->attachTags($tags);
            }

        }
    }

}
