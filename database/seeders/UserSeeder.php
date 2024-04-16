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
            'name' => 'Luiê',
            'endereco' => 'Av. João Lemos',
            'numero' => 1795,
            'cidade' => 'Bariri',
            'uf' => 'SP',
            'bairro' => 'SB',
            'cep' => '17257-000',
            'celular' => '000000000000',
            'email' => 'luie@example.com',
            'password' => bcrypt('123'),
        ]);
    }
}
