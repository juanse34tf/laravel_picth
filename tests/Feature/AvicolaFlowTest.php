<?php

namespace Tests\Feature;

use App\Livewire\BuscadorLotes;
use App\Models\Lote;
use App\Models\Produccion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AvicolaFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_puede_ver_listado_de_lotes(): void
    {
        $user = User::factory()->create();
        Lote::factory()->count(4)->create(['estado' => 'Activo']);

        $response = $this->actingAs($user)->get(route('lotes.index'));

        $response->assertStatus(200);
    }

    public function test_componente_livewire_buscador_lotes_se_carga_correctamente(): void
    {
        $user = User::factory()->create();
        Lote::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('lotes.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire(BuscadorLotes::class);
    }

    public function test_exportacion_pdf_produccion_devuelve_status_200(): void
    {
        $user = User::factory()->create();
        $lote = Lote::factory()->create(['estado' => 'Activo']);
        Produccion::factory()->count(5)->create([
            'lote_id'    => $lote->id,
            'tipo_huevo' => 'AA',
            'cantidad'   => 250,
        ]);

        $response = $this->actingAs($user)->get(route('produccion.pdf'));

        $response->assertStatus(200);
        $response->assertDownload();
    }
}
