<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_operario_no_puede_acceder_a_gastos(): void
    {
        $operario = User::factory()->create(['role' => 'operario']);

        $response = $this->actingAs($operario)->get('/gastos');

        $response->assertForbidden();
    }

    public function test_admin_puede_acceder_a_gastos(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/gastos');

        $response->assertOk();
    }

    public function test_operario_no_puede_acceder_a_ventas(): void
    {
        $operario = User::factory()->create(['role' => 'operario']);

        $response = $this->actingAs($operario)->get('/ventas');

        $response->assertForbidden();
    }

    public function test_operario_no_puede_acceder_a_usuarios(): void
    {
        $operario = User::factory()->create(['role' => 'operario']);

        $response = $this->actingAs($operario)->get('/usuarios');

        $response->assertForbidden();
    }
}
