<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            ['name'=> 'Exams'],
            ['name'=> 'Study Material'],
        ];
        foreach ($inputs as $bloCategory) {
            $input = [
                'name' => $bloCategory['name'],
            ];
            BlogCategory::create($input);
        }
    }
}
