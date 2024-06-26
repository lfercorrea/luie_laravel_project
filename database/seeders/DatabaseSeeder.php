<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Tamanho;
use App\Models\Produto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategoriaSeeder::class,
            TamanhoSeeder::class,
            ProdutoSeeder::class,
            SiteconfigSeeder::class,
        ]);
    }
}
