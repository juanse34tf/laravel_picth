<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(15);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('status', true)->orderBy('nombre')->get();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
        ]);

        Producto::create($request->only('categoria_id', 'nombre', 'precio', 'precio_venta', 'stock'));

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('status', true)->orderBy('nombre')->get();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
        ]);

        $producto->update($request->only('categoria_id', 'nombre', 'precio', 'precio_venta', 'stock'));

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
