<?php

namespace Database\Factories;

use App\Models\Produccion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produccion>
 */
class ProduccionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lote_id'       => \App\Models\Lote::factory(),
            'fecha'         => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'tipo_huevo'    => $this->faker->randomElement(['A', 'AA', 'AAA', 'B']),
            'cantidad'      => $this->faker->numberBetween(100, 500),
            'observaciones' => $this->faker->optional(0.5)->sentence(8),
        ];
    }
}
