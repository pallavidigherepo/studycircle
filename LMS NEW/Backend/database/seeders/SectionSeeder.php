<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['name' => 'A'],
            ['name' => 'B'],
            ['name' => 'C'],
            ['name' => 'D'],
            ['name' => 'RED'],
            ['name' => 'BLUE'],
            ['name' => 'GREEN'],
            ['name' => 'YELLOW'],
            ['name' => 'ORANGE']
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
