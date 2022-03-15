<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            'name'=> 'Admin',
            'email' => 'admin@meritest-cms.com',
            'password' => Hash::make(123456789),
        ];
        $user = User::create($inputs);
    }
}