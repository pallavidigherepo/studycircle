<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionType;

class QuestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Single choice'],
            ['name' => 'Multiple choice'],
            ['name' => 'Single scentence'],
            ['name' => 'Muliple scentence'],
            ['name' => 'Paragraph'],
            ['name' => 'Essay'],
            ['name' => 'Brief answer'],
            ['name' => 'Concept'],
            ['name' => 'Theorum'],
            ['name' => 'Miscellaneous'],
            ['name' => 'True or false'],
            ['name' => 'Match the pair'],
            ['name' => 'Fill in the blanks'],
            ['name' => 'Audio'],
            ['name' => 'Image'],
            ['name' => 'Video'],
        ];

        foreach ($types as $type) {
            $input = [
                'name' => json_encode($type['name'])
            ];
            QuestionType::create($input);
        }
    }
}
