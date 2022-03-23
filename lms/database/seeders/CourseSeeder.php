<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'CBSE',
                'course_code' => 'cbse',
                'created_by' => 1,
                'updated_by' => 1,
                    'children' => [
                        [    
                            'name' => '9th CBSE',
                            'course_code' => '9cbse',
                            'created_by' => 1,
                            'updated_by' => 1,
                        ],
                        [    
                            'name' => 'Textbooks',
                            'course_code' => 'txtbks',
                            'created_by' => 1,
                            'updated_by' => 1,
                                'children' => [
                                    [
                                        'name' => 'Business',
                                        'course_code' => 'busness',
                                        'created_by' => 1,
                                        'updated_by' => 1,
                                    ],
                                    [
                                        'name' => 'Finance',
                                        'course_code' => 'finance',
                                        'created_by' => 1,
                                        'updated_by' => 1,
                                    ],
                                    [
                                        'name' => 'Computer Science',
                                        'course_code' => 'compscience',
                                        'created_by' => 1,
                                        'updated_by' => 1,
                                    ],
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Banking',
                    'course_code' => 'bking',
                    'created_by' => 1,
                    'updated_by' => 1,
                        'children' => [
                        [
                            'name' => 'State Bank',
                            'course_code' => 'statebnking',
                            'created_by' => 1,
                            'updated_by' => 1,
                            'children' => [
                                [
                                    'name' => 'Clerk',
                                    'course_code' => 'clrkbnking',
                                    'created_by' => 1,
                                    'updated_by' => 1,
                                ],
                                [
                                    'name' => 'Cashier',
                                    'course_code' => 'chbnking',
                                    'created_by' => 1,
                                    'updated_by' => 1,
                                ],
                            ],
                        ],
                        [
                            'name' => 'IBPS',
                            'course_code' => 'ibps',
                            'created_by' => 1,
                            'updated_by' => 1,
                            'children' => [
                                [
                                    'name' => 'Clerk',
                                    'course_code' => 'ibpsclrk',
                                    'created_by' => 1,
                                    'updated_by' => 1,
                                ],
                                [
                                    'name' => 'Cashier',
                                    'course_code' => 'ibpscshr',
                                    'created_by' => 1,
                                    'updated_by' => 1,
                                ],
                                [
                                    'name' => 'PO',
                                    'course_code' => 'ibpspo',
                                    'created_by' => 1,
                                    'updated_by' => 1,
                                ],
                            ],
                        ],
                    ],
                ],
        ];
        foreach($courses as $course)
        {
            Course::create($course);
        }
    }
}
