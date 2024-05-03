<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tamanho;

class TamanhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            $tamanhos = [
                ['nome' => 'P', 'posicao' => 0],
                ['nome' => 'M', 'posicao' => 1],
                ['nome' => 'G', 'posicao' => 2],
                ['nome' => 'GG', 'posicao' => 3],
                ['nome' => 'XXG', 'posicao' => 4],
            ];
    
            Tamanho::insert($tamanhos);
        }
}
