<?php

namespace Tests\Unit;

use App\Models\Produccion;
use App\Models\Producto;
use PHPUnit\Framework\TestCase;

class ProduccionUnitTest extends TestCase
{
    // ─── Produccion: esDiaProductivo ────────────────────────────────────────

    public function test_produccion_es_dia_productivo_cuando_cantidad_es_positiva(): void
    {
        $produccion = new Produccion(['cantidad' => 120]);

        $this->assertTrue($produccion->esDiaProductivo());
    }

    public function test_produccion_no_es_dia_productivo_cuando_cantidad_es_cero(): void
    {
        $produccion = new Produccion(['cantidad' => 0]);

        $this->assertFalse($produccion->esDiaProductivo());
    }

    // ─── Producto: calcularMargen ────────────────────────────────────────────

    public function test_calculo_margen_positivo_cuando_precio_venta_supera_precio(): void
    {
        $producto = new Producto([
            'precio'       => 5000,
            'precio_venta' => 7500,
        ]);

        $this->assertEquals(2500.0, $producto->calcularMargen());
    }

    public function test_margen_es_cero_cuando_precio_igual_a_precio_venta(): void
    {
        $producto = new Producto([
            'precio'       => 3000,
            'precio_venta' => 3000,
        ]);

        $this->assertEquals(0.0, $producto->calcularMargen());
    }

    public function test_margen_negativo_refleja_venta_a_perdida(): void
    {
        $producto = new Producto([
            'precio'       => 8000,
            'precio_venta' => 6000,
        ]);

        $this->assertEquals(-2000.0, $producto->calcularMargen());
    }
}
