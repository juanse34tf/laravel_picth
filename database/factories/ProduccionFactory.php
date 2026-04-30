<?php

namespace Database\Factories;

use App\Models\Produccion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produccion>
 */
class ProduccionFactory extends Factory
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
            'lote_id'       => \App\Models\Lote::factory(),
            'fecha'         => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'tipo_huevo'    => $faker->randomElement(['Blanco AA', 'Blanco A', 'Marrón AA', 'Marrón A', 'Blanco B']),
            'cantidad'      => $faker->numberBetween(200, 3000),
            'observaciones' => $faker->optional(0.5)->sentence(10),
        ];
    }
}
