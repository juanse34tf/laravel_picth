<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    private function usuario(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_puede_listar_categorias(): void
    {
        Categoria::factory()->count(3)->create();

        $response = $this->actingAs($this->usuario())->get(route('categorias.index'));

        $response->assertStatus(200);
        $response->assertViewHas('categorias');
    }

    public function test_puede_crear_una_categoria(): void
    {
        $datos = [
            'nombre'      => 'Categoría de Prueba',
            'descripcion' => 'Descripción generada para el test de integración.',
            'status'      => 1,
        ];

        $response = $this->actingAs($this->usuario())->post(route('categorias.store'), $datos);

        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', ['nombre' => 'Categoría de Prueba']);
    }

    public function test_puede_actualizar_una_categoria(): void
    {
        $categoria = Categoria::factory()->create(['nombre' => 'Nombre Original']);

        $response = $this->actingAs($this->usuario())->put(
            route('categorias.update', $categoria),
            [
                'nombre'      => 'Nombre Actualizado',
                'descripcion' => 'Descripción actualizada en el test.',
                'status'      => 1,
            ]
        );

        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseHas('categorias', ['nombre' => 'Nombre Actualizado']);
    }

    public function test_puede_eliminar_una_categoria(): void
    {
        $categoria = Categoria::factory()->create();

        $response = $this->actingAs($this->usuario())->delete(route('categorias.destroy', $categoria));

        $response->assertRedirect(route('categorias.index'));
        $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);
    }
}
