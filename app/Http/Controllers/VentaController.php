<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->orderBy('fecha', 'desc')->paginate(15);
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'total'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
        ]);

        Venta::create($request->only('producto_id', 'cantidad', 'total', 'fecha'));

        return redirect()->route('ventas.index')
            ->with('success', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta)
    {
        return redirect()->route('ventas.index');
    }

    public function edit(Venta $venta)
    {
        $productos = Producto::orderBy('nombre')->get();
        return view('ventas.edit', compact('venta', 'productos'));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'total'       => 'required|numeric|min:0',
            'fecha'       => 'required|date',
        ]);

        $venta->update($request->only('producto_id', 'cantidad', 'total', 'fecha'));

        return redirect()->route('ventas.index')
            ->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();

        return redirect()->route('ventas.index')
            ->with('success', 'Venta eliminada correctamente.');
    }
}
