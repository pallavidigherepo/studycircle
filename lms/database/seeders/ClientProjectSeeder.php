<?php

namespace Database\Seeders;

use App\Models\ClientProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientProject::create([
            'client_name' => 'era',
            'connection' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'era',
            'username' => 'root',
            'password' => ""
        ]);
    }
}
