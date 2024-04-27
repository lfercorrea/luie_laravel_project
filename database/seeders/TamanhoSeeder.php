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
                ['nome' => 'P'],
                ['nome' => 'M'],
                ['nome' => 'G'],
                ['nome' => 'GG'],
                ['nome' => 'XXG'],
            ];
    
            Tamanho::insert($tamanhos);
        }
}
