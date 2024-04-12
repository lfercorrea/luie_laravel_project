<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siteconfig>
 */
class SiteconfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->name(),
            'brand_logo' => fake()->name(),
            'endereco' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->number(),
            'celular' => fake()->number(),
        ];
    }
}
