<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categoria::factory(20)->create();
        Categoria::create([
            'nome' => 'Lingeries',
            'descricao' => 'Descrição para lingeries',
            'imagem' => 'static/images/no_photo.gif',
        ]);

        Categoria::create([
            'nome' => 'Pijamas',
            'descricao' => 'Descrição para pijamas',
            'imagem' => 'static/images/no_photo.gif',
        ]);
    }
}
