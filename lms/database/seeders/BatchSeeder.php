<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => '2022-2023'],
        ];

        foreach ($types as $type) {
            $input = [
                'name' => $type['name']
            ];
            Batch::create($input);
        }
    }
}
