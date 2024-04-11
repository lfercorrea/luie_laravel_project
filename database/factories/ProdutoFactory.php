<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = ucfirst($this->faker->unique()->word);

        // populacao inicial da tabela
        return [
            'quantidade' => random_int(1, 20),
            'nome' => $nome,
            'descricao' => $this->faker->text,
            'preco' => $this->faker->randomFloat(2, 0, 1000),  // randomFloat(casas, inicio, fim)
            'slug' => Str::slug($nome),
            // 'imagem' => $this->faker->imageUrl(400, 400),
            'id_user' => User::pluck('id')->random(),
            'id_categoria' => Categoria::pluck('id')->random(),
        ];
    }
}
