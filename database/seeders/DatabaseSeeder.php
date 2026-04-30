<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Lote;
use App\Models\Produccion;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Usuario de demostración
        User::factory()->create([
            'name'     => 'Admin Avícola',
            'email'    => 'admin@avicola.com',
            'password' => bcrypt('password'),
        ]);

        // 4 Categorías fijas y representativas
        $categorias = collect([
            ['nombre' => 'Alimentos',    'descripcion' => 'Concentrados, harinas y suplementos alimenticios para aves.',      'status' => true],
            ['nombre' => 'Medicamentos', 'descripcion' => 'Vitaminas, antibióticos y productos veterinarios para el plantel.', 'status' => true],
            ['nombre' => 'Insumos',      'descripcion' => 'Materiales de operación diaria: viruta, cal, empaques y más.',     'status' => true],
            ['nombre' => 'Equipos',      'descripcion' => 'Bebederos, comederos, incubadoras y herramientas de granja.',      'status' => true],
        ])->map(fn ($d) => Categoria::create($d));

        // 15 Productos distribuidos (3 + 4 + 4 + 4)
        $productos = [
            // Alimentos
            ['nombre' => 'Concentrado Inicio 22%',   'precio' => 45000, 'precio_venta' => 52000, 'stock' => 80],
            ['nombre' => 'Maíz Triturado Fino',       'precio' => 28000, 'precio_venta' => 33000, 'stock' => 150],
            ['nombre' => 'Soya Integral Tostada',     'precio' => 62000, 'precio_venta' => 70000, 'stock' => 60],
            // Medicamentos
            ['nombre' => 'Vitamina AD3E Líquida',     'precio' => 18000, 'precio_venta' => 24000, 'stock' => 40],
            ['nombre' => 'Antibiótico Enrofloxacina', 'precio' => 35000, 'precio_venta' => 42000, 'stock' => 25],
            ['nombre' => 'Vacuna Newcastle Live',     'precio' => 55000, 'precio_venta' => 65000, 'stock' => 20],
            ['nombre' => 'Desparasitante Oral 1L',    'precio' => 22000, 'precio_venta' => 28000, 'stock' => 35],
            // Insumos
            ['nombre' => 'Viruta de Pino x50kg',      'precio' => 12000, 'precio_venta' => 16000, 'stock' => 100],
            ['nombre' => 'Cal Viva x25kg',            'precio' =>  8500, 'precio_venta' => 11000, 'stock' => 75],
            ['nombre' => 'Empaque Cartón 30 Huevos',  'precio' =>  3200, 'precio_venta' =>  4500, 'stock' => 500],
            ['nombre' => 'Desinfectante Granja 5L',   'precio' => 15000, 'precio_venta' => 19000, 'stock' => 30],
            // Equipos
            ['nombre' => 'Bebedero Automático 10L',   'precio' => 95000, 'precio_venta' => 115000, 'stock' => 12],
            ['nombre' => 'Comedero Tolva 15kg',        'precio' => 48000, 'precio_venta' =>  58000, 'stock' => 18],
            ['nombre' => 'Foco Infrarrojo 250W',       'precio' => 32000, 'precio_venta' =>  40000, 'stock' => 22],
            ['nombre' => 'Termómetro Digital Granja',  'precio' => 25000, 'precio_venta' =>  31000, 'stock' => 15],
        ];

        $asignacion = array_merge(
            array_fill(0, 3, $categorias[0]->id),
            array_fill(0, 4, $categorias[1]->id),
            array_fill(0, 4, $categorias[2]->id),
            array_fill(0, 4, $categorias[3]->id)
        );

        foreach ($productos as $i => $prod) {
            Producto::create(array_merge($prod, ['categoria_id' => $asignacion[$i]]));
        }

        // 3 Lotes activos con fechas escalonadas
        $lotes = collect([
            ['cantidad' => 2500, 'fecha_inicio' => '2024-01-15', 'estado' => 'Activo'],
            ['cantidad' => 3200, 'fecha_inicio' => '2024-04-01', 'estado' => 'Activo'],
            ['cantidad' => 1800, 'fecha_inicio' => '2024-07-10', 'estado' => 'Activo'],
        ])->map(fn ($d) => Lote::create($d));

        // 20 Producciones distribuidas entre los 3 lotes
        $tipos = ['Blanco AA', 'Blanco A', 'Marrón AA', 'Marrón A', 'Blanco B'];
        $observaciones = [
            'Producción normal sin incidencias.',
            'Leve descenso por cambios climáticos.',
            null,
            'Mejora tras suministro de vitaminas.',
            null,
            'Producción esperada para la temporada.',
            null,
        ];

        $base = strtotime('2024-08-01');
        for ($i = 0; $i < 20; $i++) {
            Produccion::create([
                'lote_id'       => $lotes[$i % 3]->id,
                'fecha'         => date('Y-m-d', $base + $i * 5 * 86400),
                'tipo_huevo'    => $tipos[$i % count($tipos)],
                'cantidad'      => rand(800, 2400),
                'observaciones' => $observaciones[$i % count($observaciones)],
            ]);
        }
    }
}
