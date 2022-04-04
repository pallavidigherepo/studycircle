<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            LanguageSeeder::class,
            DifficultyLevelSeeder::class,
            QuestTypeSeeder::class,
            BoardSeeder::class,
            StandardSeeder::class,
            //CourseSeeder::class,
            //CourseTypeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

    }
}