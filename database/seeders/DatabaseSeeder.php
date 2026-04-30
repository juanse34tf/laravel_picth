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
        // ─── Usuario administrador fijo ───────────────────────────────────────
        User::factory()->create([
            'name'     => 'Administrador',
            'email'    => 'admin@gallinas.com',
            'password' => bcrypt('password'),
        ]);

        // ─── 5 Categorías representativas ────────────────────────────────────
        $categorias = collect([
            ['nombre' => 'Alimentos',    'descripcion' => 'Concentrados, harinas y suplementos alimenticios para aves.',      'status' => true],
            ['nombre' => 'Medicamentos', 'descripcion' => 'Vitaminas, antibióticos y productos veterinarios para el plantel.', 'status' => true],
            ['nombre' => 'Insumos',      'descripcion' => 'Materiales de operación diaria: viruta, cal, empaques y más.',     'status' => true],
            ['nombre' => 'Equipos',      'descripcion' => 'Bebederos, comederos, incubadoras y herramientas de granja.',      'status' => true],
            ['nombre' => 'Suplementos',  'descripcion' => 'Calcio, electrolitos, probióticos y aminoácidos para producción.', 'status' => true],
        ])->map(fn ($d) => Categoria::create($d));

        // ─── 20 Productos (4 por categoría) ──────────────────────────────────
        $productos = [
            // Alimentos (4)
            ['nombre' => 'Concentrado Inicio 22%',    'precio' => 45000, 'precio_venta' =>  52000, 'stock' =>  80],
            ['nombre' => 'Maíz Triturado Fino',        'precio' => 28000, 'precio_venta' =>  33000, 'stock' => 150],
            ['nombre' => 'Soya Integral Tostada',      'precio' => 62000, 'precio_venta' =>  70000, 'stock' =>  60],
            ['nombre' => 'Harina de Pescado x50kg',    'precio' => 78000, 'precio_venta' =>  90000, 'stock' =>  35],
            // Medicamentos (4)
            ['nombre' => 'Vitamina AD3E Líquida',      'precio' => 18000, 'precio_venta' =>  24000, 'stock' =>  40],
            ['nombre' => 'Antibiótico Enrofloxacina',  'precio' => 35000, 'precio_venta' =>  42000, 'stock' =>  25],
            ['nombre' => 'Vacuna Newcastle Live',      'precio' => 55000, 'precio_venta' =>  65000, 'stock' =>  20],
            ['nombre' => 'Desparasitante Oral 1L',     'precio' => 22000, 'precio_venta' =>  28000, 'stock' =>  35],
            // Insumos (4)
            ['nombre' => 'Viruta de Pino x50kg',       'precio' => 12000, 'precio_venta' =>  16000, 'stock' => 100],
            ['nombre' => 'Cal Viva x25kg',             'precio' =>  8500, 'precio_venta' =>  11000, 'stock' =>  75],
            ['nombre' => 'Empaque Cartón 30 Huevos',   'precio' =>  3200, 'precio_venta' =>   4500, 'stock' => 500],
            ['nombre' => 'Desinfectante Granja 5L',    'precio' => 15000, 'precio_venta' =>  19000, 'stock' =>  30],
            // Equipos (4)
            ['nombre' => 'Bebedero Automático 10L',    'precio' => 95000, 'precio_venta' => 115000, 'stock' =>  12],
            ['nombre' => 'Comedero Tolva 15kg',         'precio' => 48000, 'precio_venta' =>  58000, 'stock' =>  18],
            ['nombre' => 'Foco Infrarrojo 250W',        'precio' => 32000, 'precio_venta' =>  40000, 'stock' =>  22],
            ['nombre' => 'Termómetro Digital Granja',   'precio' => 25000, 'precio_venta' =>  31000, 'stock' =>  15],
            // Suplementos (4)
            ['nombre' => 'Calcio Micronizado 5kg',      'precio' => 19000, 'precio_venta' =>  24000, 'stock' =>  50],
            ['nombre' => 'Probiótico Avícola 1L',       'precio' => 27000, 'precio_venta' =>  33000, 'stock' =>  40],
            ['nombre' => 'Aminoácidos Esenciales 2kg',  'precio' => 42000, 'precio_venta' =>  51000, 'stock' =>  28],
            ['nombre' => 'Electrolitos Repone 500g',    'precio' => 14000, 'precio_venta' =>  18000, 'stock' =>  60],
        ];

        $asignacion = array_merge(
            array_fill(0, 4, $categorias[0]->id),
            array_fill(0, 4, $categorias[1]->id),
            array_fill(0, 4, $categorias[2]->id),
            array_fill(0, 4, $categorias[3]->id),
            array_fill(0, 4, $categorias[4]->id),
        );

        foreach ($productos as $i => $prod) {
            Producto::create(array_merge($prod, ['categoria_id' => $asignacion[$i]]));
        }

        // ─── 4 Lotes con estados variados ────────────────────────────────────
        $lotes = collect([
            ['cantidad' => 2500, 'fecha_inicio' => '2024-01-15', 'estado' => 'Activo'],
            ['cantidad' => 3200, 'fecha_inicio' => '2024-04-01', 'estado' => 'Activo'],
            ['cantidad' => 1800, 'fecha_inicio' => '2024-07-10', 'estado' => 'En Descanso'],
            ['cantidad' => 4100, 'fecha_inicio' => '2024-10-05', 'estado' => 'Activo'],
        ])->map(fn ($d) => Lote::create($d));

        // ─── 50 Registros de producción ───────────────────────────────────────
        $tipos = ['A', 'AA', 'AAA', 'B'];
        $observaciones = [
            'Producción normal sin incidencias.',
            'Leve descenso por cambios climáticos.',
            null,
            'Mejora tras suministro de vitaminas.',
            null,
            'Producción esperada para la temporada.',
            null,
            'Alta producción registrada esta semana.',
            null,
            'Revisión veterinaria programada.',
        ];

        $base = strtotime('2024-01-08');
        for ($i = 0; $i < 50; $i++) {
            Produccion::create([
                'lote_id'       => $lotes[$i % 4]->id,
                'fecha'         => date('Y-m-d', $base + $i * 7 * 86400),
                'tipo_huevo'    => $tipos[$i % 4],
                'cantidad'      => rand(100, 500),
                'observaciones' => $observaciones[$i % count($observaciones)],
            ]);
        }
    }
}
