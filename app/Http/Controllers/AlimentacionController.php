<?php

namespace App\Http\Controllers;

use App\Models\Alimentacion;
use App\Models\Lote;
use Illuminate\Http\Request;

class AlimentacionController extends Controller
{
    public function index()
    {
        $alimentaciones = Alimentacion::with('lote')->orderBy('fecha', 'desc')->paginate(15);
        return view('alimentacion.index', compact('alimentaciones'));
    }

    public function create()
    {
        $lotes = Lote::orderBy('id', 'desc')->get();
        return view('alimentacion.create', compact('lotes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lote_id'      => 'required|exists:lotes,id',
            'tipo_alimento'=> 'required|string|max:100',
            'cantidad_kg'  => 'required|numeric|min:0.1',
            'fecha'        => 'required|date',
        ]);

        Alimentacion::create($request->only('lote_id', 'tipo_alimento', 'cantidad_kg', 'fecha'));

        return redirect()->route('alimentacion.index')
            ->with('success', 'Registro de alimentación creado correctamente.');
    }

    public function show(Alimentacion $alimentacion)
    {
        return redirect()->route('alimentacion.index');
    }

    public function edit(Alimentacion $alimentacion)
    {
        $lotes = Lote::orderBy('id', 'desc')->get();
        return view('alimentacion.edit', compact('alimentacion', 'lotes'));
    }

    public function update(Request $request, Alimentacion $alimentacion)
    {
        $request->validate([
            'lote_id'      => 'required|exists:lotes,id',
            'tipo_alimento'=> 'required|string|max:100',
            'cantidad_kg'  => 'required|numeric|min:0.1',
            'fecha'        => 'required|date',
        ]);

        $alimentacion->update($request->only('lote_id', 'tipo_alimento', 'cantidad_kg', 'fecha'));

        return redirect()->route('alimentacion.index')
            ->with('success', 'Registro de alimentación actualizado correctamente.');
    }

    public function destroy(Alimentacion $alimentacion)
    {
        $alimentacion->delete();

        return redirect()->route('alimentacion.index')
            ->with('success', 'Registro de alimentación eliminado correctamente.');
    }
}
