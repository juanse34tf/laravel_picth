<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlujoVentasFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Flujo completo: administrador crea un producto, registra una venta
     * y el stock del producto disminuye correctamente.
     */
    public function test_admin_crea_producto_registra_venta_y_stock_disminuye(): void
    {
        // 1. Preparar usuario administrador
        $admin = User::factory()->create(['role' => 'admin']);

        // 2. Crear categoría base (necesaria para el producto)
        $categoria = Categoria::factory()->create(['status' => true]);

        // 3. Crear un producto vía HTTP (simulando el formulario)
        $this->actingAs($admin)->post(route('productos.store'), [
            'categoria_id' => $categoria->id,
            'nombre'       => 'Huevo de Gallina Roja',
            'precio'       => 5000,
            'precio_venta' => 7000,
            'stock'        => 100,
        ])->assertRedirect(route('productos.index'));

        $this->assertDatabaseHas('productos', ['nombre' => 'Huevo de Gallina Roja']);

        $producto = Producto::where('nombre', 'Huevo de Gallina Roja')->firstOrFail();
        $stockInicial = $producto->stock; // 100

        // 4. Registrar una venta como administrador
        $this->actingAs($admin)->post(route('ventas.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 10,
            'total'       => 70000,
            'fecha'       => '2026-05-09',
        ])->assertRedirect(route('ventas.index'));

        // 5. Verificar que la venta quedó en base de datos
        $this->assertDatabaseHas('ventas', [
            'producto_id' => $producto->id,
            'cantidad'    => 10,
            'total'       => 70000.00,
        ]);

        // 6. Verificar que el stock disminuyó exactamente en la cantidad vendida
        $producto->refresh();
        $this->assertEquals($stockInicial - 10, $producto->stock);
    }

    public function test_venta_falla_cuando_stock_es_insuficiente(): void
    {
        $admin   = User::factory()->create(['role' => 'admin']);
        $producto = Producto::factory()->create(['stock' => 5]);

        $this->actingAs($admin)->post(route('ventas.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 50,
            'total'       => 350000,
            'fecha'       => '2026-05-09',
        ])->assertSessionHasErrors('cantidad');

        // El stock no debe haber cambiado
        $producto->refresh();
        $this->assertEquals(5, $producto->stock);
    }

    public function test_operario_no_puede_registrar_ventas(): void
    {
        $operario = User::factory()->create(['role' => 'operario']);
        $producto  = Producto::factory()->create(['stock' => 100]);

        $this->actingAs($operario)->post(route('ventas.store'), [
            'producto_id' => $producto->id,
            'cantidad'    => 1,
            'total'       => 7000,
            'fecha'       => '2026-05-09',
        ])->assertForbidden();
    }
}
