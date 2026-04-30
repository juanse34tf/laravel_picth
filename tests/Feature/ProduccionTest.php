<?php

namespace Tests\Feature;

use App\Models\Lote;
use App\Models\Produccion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProduccionTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_puede_ver_index_produccion(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('produccion.index'));

        $response->assertStatus(200);
    }

    public function test_usuario_no_autenticado_es_redirigido_al_login(): void
    {
        $response = $this->get(route('produccion.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_usuario_puede_crear_produccion_valida(): void
    {
        $user = User::factory()->create();
        $lote = Lote::factory()->create(['estado' => 'Activo']);

        $response = $this->actingAs($user)->post(route('produccion.store'), [
            'lote_id'       => $lote->id,
            'fecha'         => '2024-09-15',
            'tipo_huevo'    => 'Blanco AA',
            'cantidad'      => 1500,
            'observaciones' => 'Registro de prueba.',
        ]);

        $response->assertRedirect(route('produccion.index'));
        $this->assertDatabaseHas('produccions', [
            'lote_id'    => $lote->id,
            'tipo_huevo' => 'Blanco AA',
            'cantidad'   => 1500,
        ]);
    }

    public function test_store_produccion_falla_sin_campos_requeridos(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('produccion.store'), []);

        $response->assertSessionHasErrors(['lote_id', 'fecha', 'tipo_huevo', 'cantidad']);
    }

    public function test_exportar_pdf_devuelve_respuesta_exitosa(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('produccion.pdf'));

        $response->assertStatus(200);
        $response->assertDownload();
    }
}
