<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        return view('lotes.index');
    }

    public function create()
    {
        return view('lotes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cantidad'    => 'required|integer|min:1',
            'fecha_inicio'=> 'required|date',
            'estado'      => 'required|string|max:50',
        ]);

        Lote::create($request->only('cantidad', 'fecha_inicio', 'estado'));

        return redirect()->route('lotes.index')
            ->with('success', 'Lote creado correctamente.');
    }

    public function show(Lote $lote)
    {
        return redirect()->route('lotes.index');
    }

    public function edit(Lote $lote)
    {
        return view('lotes.edit', compact('lote'));
    }

    public function update(Request $request, Lote $lote)
    {
        $request->validate([
            'cantidad'    => 'required|integer|min:1',
            'fecha_inicio'=> 'required|date',
            'estado'      => 'required|string|max:50',
        ]);

        $lote->update($request->only('cantidad', 'fecha_inicio', 'estado'));

        return redirect()->route('lotes.index')
            ->with('success', 'Lote actualizado correctamente.');
    }

    public function destroy(Lote $lote)
    {
        $lote->delete();

        return redirect()->route('lotes.index')
            ->with('success', 'Lote eliminado correctamente.');
    }
}
