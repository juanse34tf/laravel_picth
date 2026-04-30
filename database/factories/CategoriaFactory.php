<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre'      => $this->faker->unique()->randomElement([
                'Alimentos', 'Medicamentos', 'Insumos', 'Equipos', 'Suplementos',
                'Herramientas', 'Vacunas', 'Empaques',
            ]),
            'descripcion' => $this->faker->sentence(8),
            'status'      => $this->faker->boolean(90),
        ];
    }
}
