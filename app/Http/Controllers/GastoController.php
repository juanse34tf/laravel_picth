<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    public function index()
    {
        $gastos = Gasto::orderBy('fecha', 'desc')->paginate(15);
        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        return view('gastos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
        ]);

        Gasto::create($request->only('descripcion', 'monto', 'fecha'));

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto registrado correctamente.');
    }

    public function show(Gasto $gasto)
    {
        return redirect()->route('gastos.index');
    }

    public function edit(Gasto $gasto)
    {
        return view('gastos.edit', compact('gasto'));
    }

    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'monto'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
        ]);

        $gasto->update($request->only('descripcion', 'monto', 'fecha'));

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto actualizado correctamente.');
    }

    public function destroy(Gasto $gasto)
    {
        $gasto->delete();

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto eliminado correctamente.');
    }
}
