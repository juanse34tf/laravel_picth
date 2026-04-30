<?php

namespace Tests\Feature;

use App\Livewire\BuscadorLotes;
use App\Models\Lote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoteBuscadorTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_lotes_renderiza_componente_livewire(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('lotes.index'));

        $response->assertStatus(200);
        $response->assertSeeLivewire(BuscadorLotes::class);
    }

    public function test_componente_muestra_todos_los_lotes_sin_busqueda(): void
    {
        $user = User::factory()->create();
        Lote::factory()->count(3)->create(['estado' => 'Activo']);

        Livewire::actingAs($user)
            ->test(BuscadorLotes::class)
            ->assertSee('Activo');
    }

    public function test_busqueda_filtra_lotes_por_estado(): void
    {
        $user = User::factory()->create();
        Lote::factory()->create(['estado' => 'Activo',     'cantidad' => 1000, 'fecha_inicio' => '2024-01-01']);
        Lote::factory()->create(['estado' => 'Finalizado', 'cantidad' =>  500, 'fecha_inicio' => '2023-06-01']);

        Livewire::actingAs($user)
            ->test(BuscadorLotes::class)
            ->set('search', 'Finalizado')
            ->assertSee('Finalizado')
            ->assertDontSee('1.000');
    }

    public function test_busqueda_sin_resultados_muestra_mensaje(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(BuscadorLotes::class)
            ->set('search', 'TerminoInexistente')
            ->assertSee('No se encontraron lotes con');
    }

    public function test_propiedad_search_inicia_vacia(): void
    {
        Livewire::test(BuscadorLotes::class)
            ->assertSet('search', '');
    }
}
