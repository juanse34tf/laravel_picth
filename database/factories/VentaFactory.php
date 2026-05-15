<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Venta>
 */
class VentaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'producto_id' => \App\Models\Producto::factory(),
            'cantidad'    => $this->faker->numberBetween(1, 50),
            'total'       => $this->faker->randomFloat(2, 5000, 500000),
            'fecha'       => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
