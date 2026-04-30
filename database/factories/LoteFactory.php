<?php

namespace Database\Factories;

use App\Models\Lote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lote>
 */
class LoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cantidad'     => $this->faker->numberBetween(500, 5000),
            'fecha_inicio' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'estado'       => $this->faker->randomElement(['Activo', 'En Descanso', 'Finalizado']),
        ];
    }
}
