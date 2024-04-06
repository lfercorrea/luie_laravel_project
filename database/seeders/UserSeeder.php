<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // cria o usuário que tem poder total no sistema
        User::create([
            'level' => 1,
            'name' => 'nando',
            'email' => 'lfercorrea@gmail.com',
            'password' => bcrypt('luiscorrea'),
        ]);
    }
}
