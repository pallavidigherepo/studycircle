<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoursesType;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseTypes = [
            [
                'label' => 'Complete Course',
                'description' => 'Complete Course',
            ],
            [
                'label' => 'Crash Course',
                'description' => 'Crash Course',
            ],
            [
                'label' => 'Half Yearly',
                'description' => 'Half yearly course',
            ]
        ];

        foreach ($courseTypes as $courseType) {
            CoursesType::create($courseType);
        }
    }
}
