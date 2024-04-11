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
            // 'foto' => 'static/images/img_avatar.png',
            'endereco' => 'Rua Dominique Danesi',
            'numero' => 34,
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'bairro' => 'Parque Maria Fernanda',
            'cep' => 14033035,
            'celular' => 18996073988,
            'email' => 'lfercorrea@gmail.com',
            'password' => bcrypt('luiscorrea'),
        ]);
    }
}
