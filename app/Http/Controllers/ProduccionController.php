<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Produccion;
use Barryvdh\LaravelDompdf\Facade\Pdf;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index()
    {
        $producciones = Produccion::with('lote')->paginate(15);
        return view('produccion.index', compact('producciones'));
    }

    public function create()
    {
        $lotes = Lote::where('estado', 'Activo')->orderBy('id', 'desc')->get();
        return view('produccion.create', compact('lotes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lote_id'       => 'required|exists:lotes,id',
            'fecha'         => 'required|date',
            'tipo_huevo'    => 'required|string|max:100',
            'cantidad'      => 'required|integer|min:1',
            'observaciones' => 'nullable|string',
        ]);

        Produccion::create($request->only('lote_id', 'fecha', 'tipo_huevo', 'cantidad', 'observaciones'));

        return redirect()->route('produccion.index')
            ->with('success', 'Registro de producción creado correctamente.');
    }

    public function show(Produccion $produccion)
    {
        return redirect()->route('produccion.index');
    }

    public function edit(Produccion $produccion)
    {
        $lotes = Lote::where('estado', 'Activo')->orderBy('id', 'desc')->get();
        return view('produccion.edit', compact('produccion', 'lotes'));
    }

    public function update(Request $request, Produccion $produccion)
    {
        $request->validate([
            'lote_id'       => 'required|exists:lotes,id',
            'fecha'         => 'required|date',
            'tipo_huevo'    => 'required|string|max:100',
            'cantidad'      => 'required|integer|min:1',
            'observaciones' => 'nullable|string',
        ]);

        $produccion->update($request->only('lote_id', 'fecha', 'tipo_huevo', 'cantidad', 'observaciones'));

        return redirect()->route('produccion.index')
            ->with('success', 'Registro de producción actualizado correctamente.');
    }

    public function destroy(Produccion $produccion)
    {
        $produccion->delete();

        return redirect()->route('produccion.index')
            ->with('success', 'Registro de producción eliminado correctamente.');
    }

    public function exportPdf()
    {
        $producciones = Produccion::with('lote')->orderBy('fecha', 'desc')->get();
        $pdf = Pdf::loadView('produccion.pdf', compact('producciones'));
        return $pdf->download('produccion_' . now()->format('Y-m-d') . '.pdf');
    }
}
