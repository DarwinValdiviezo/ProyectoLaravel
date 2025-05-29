<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Categoria;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);

        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Producto::create($request->only('nombre', 'precio', 'stock', 'categoria_id'));

        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);
    $categorias = Categoria::all();
    return view('productos.edit', compact('producto', 'categorias'));
}

public function update(Request $request, Producto $producto)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);

    $request->validate([
        'nombre' => 'required',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $producto->update($request->only('nombre', 'precio', 'stock', 'categoria_id'));

    return redirect()->route('productos.index');
}

public function destroy(Producto $producto)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);
    $producto->delete();

    return redirect()->route('productos.index');
}

}
