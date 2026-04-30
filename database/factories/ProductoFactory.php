<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker   = \Faker\Factory::create('es_ES');
        $precio  = $faker->randomFloat(2, 5000, 80000);
        return [
            'categoria_id' => \App\Models\Categoria::factory(),
            'nombre'       => $faker->words(3, true),
            'precio'       => $precio,
            'precio_venta' => round($precio * $faker->randomFloat(2, 1.10, 1.40), 2),
            'stock'        => $faker->numberBetween(0, 500),
        ];
    }
}
