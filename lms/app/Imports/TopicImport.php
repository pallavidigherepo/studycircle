<?php

namespace App\Imports;

use App\Models\Chapter;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class TopicImport implements ToCollection, WithHeadingRow
{
    use Exportable;
    private $isDemo;

    public function __construct(int $chapter, bool $demo = false)
    {
        $this->parent_id = $chapter;
        $this->isDemo = $demo;
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
            '*.label' => 'required',
            //'label' => 'required|unique:subjects',
            // Above is alias for as it always validates in batches
            //'*.label' => 'required|unique:subjects',

            // Can also use callback validation rules
            //'description' => 'required',
            '*.description' => 'required'
         ])->validate();
        $chapter = Chapter::findOrFail($this->parent_id);
        foreach ($rows as $row) {
            $tags = explode(',', $row['tags']);

            $inputs = [
                'label' => json_encode($row['label']),
                'description' => json_encode($row['description']),
                'board_id' => $chapter->board_id,
                'standard_id' => $chapter->standard_id,
                'parent_id' => $this->parent_id,
                'icon' => $row['icon'],
                'language_id' => $row['language_id'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            $topic = Topic::create($inputs);
            $topic->detachTags($tags);
            $topic->attachTags($tags);
        }
    }
}
