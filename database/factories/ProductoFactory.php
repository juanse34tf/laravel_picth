<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        $precio = $this->faker->randomFloat(2, 5000, 80000);
        return [
            'categoria_id' => \App\Models\Categoria::factory(),
            'nombre'       => $this->faker->words(3, true),
            'precio'       => $precio,
            'precio_venta' => round($precio * $this->faker->randomFloat(2, 1.10, 1.40), 2),
            'stock'        => $this->faker->numberBetween(0, 500),
        ];
    }
}
