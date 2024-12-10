<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Music', 'Sport', 'Tech']), // Elige un tipo al azar del enumerado
            'description' => $this->faker->text(100), // Genera una descripción aleatoria
            'deleted' => 0, // Por defecto, no está eliminado
        ];
    }
}
