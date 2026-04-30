<?php

namespace App\Http\Controllers;

use App\Models\Alimentacion;
use App\Models\Gasto;
use App\Models\Lote;
use App\Models\Produccion;
use App\Models\Venta;

class ReporteController extends Controller
{
    public function index()
    {
        $totalVentas      = Venta::sum('total');
        $totalGastos      = Gasto::sum('monto');
        $totalAlimento    = Alimentacion::sum('cantidad_kg');
        $totalProduccion  = Produccion::sum('cantidad');
        $lotesActivos     = Lote::where('estado', 'Activo')->count();

        $ventasPorMes = Venta::selectRaw("strftime('%Y-%m', fecha) as mes, SUM(total) as total")
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->limit(6)
            ->get();

        $gastosPorMes = Gasto::selectRaw("strftime('%Y-%m', fecha) as mes, SUM(monto) as total")
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->limit(6)
            ->get();

        $produccionPorTipo = Produccion::selectRaw('tipo_huevo, SUM(cantidad) as total')
            ->groupBy('tipo_huevo')
            ->orderBy('total', 'desc')
            ->get();

        return view('reportes.index', compact(
            'totalVentas',
            'totalGastos',
            'totalAlimento',
            'totalProduccion',
            'lotesActivos',
            'ventasPorMes',
            'gastosPorMes',
            'produccionPorTipo'
        ));
    }
}
