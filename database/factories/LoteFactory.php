<?php

namespace Database\Factories;

use App\Models\Lote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lote>
 */
class LoteFactory extends Factory
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
            'cantidad'    => $faker->numberBetween(500, 5000),
            'fecha_inicio'=> $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'estado'      => $faker->randomElement(['Activo', 'Finalizado', 'En Espera']),
        ];
    }
}
