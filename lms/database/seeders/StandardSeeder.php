<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Standard;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => '9th'],
            ['name' => '10th'],
            ['name' => '11th'],
            ['name' => '12th'],
        ];

        foreach ($types as $type) {
            $input = [
                'name' => $type['name']
            ];
            Standard::create($input);
        }
    }
}
