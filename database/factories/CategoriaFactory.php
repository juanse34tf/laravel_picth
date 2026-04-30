<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('es_ES');
        return [
            'nombre'      => $faker->unique()->randomElement([
                'Alimentos', 'Medicamentos', 'Insumos', 'Equipos',
                'Herramientas', 'Vacunas', 'Suplementos', 'Empaques',
            ]),
            'descripcion' => $faker->sentence(8),
            'status'      => $faker->boolean(90),
        ];
    }
}
