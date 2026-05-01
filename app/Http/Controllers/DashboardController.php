<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Produccion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Últimos 7 días: etiquetas y totales diarios
        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

        $produccionPorDia = Produccion::whereBetween('fecha', [
            now()->subDays(6)->format('Y-m-d'),
            now()->format('Y-m-d'),
        ])
            ->selectRaw('fecha, SUM(cantidad) as total')
            ->groupBy('fecha')
            ->pluck('total', 'fecha');

        $labelsProduccion = $days->map(fn ($d) => Carbon::parse($d)->format('d/m'));
        $datosProduccion  = $days->map(fn ($d) => (int) ($produccionPorDia[$d] ?? 0));

        // Proporción por tipo de huevo (histórico total)
        $tiposHuevo = Produccion::whereIn('tipo_huevo', ['A', 'AA', 'AAA'])
            ->selectRaw('tipo_huevo, SUM(cantidad) as total')
            ->groupBy('tipo_huevo')
            ->pluck('total', 'tipo_huevo');

        return view('dashboard', [
            'labelsProduccion' => $labelsProduccion->values()->toJson(),
            'datosProduccion'  => $datosProduccion->values()->toJson(),
            'datosHuevo'       => collect(['A', 'AA', 'AAA'])
                ->map(fn ($t) => (int) ($tiposHuevo[$t] ?? 0))
                ->values()->toJson(),
            'totalSemana'      => $datosProduccion->sum(),
            'lotesActivos'     => Lote::where('estado', 'Activo')->count(),
            'totalHistorico'   => Produccion::sum('cantidad'),
        ]);
    }
}
