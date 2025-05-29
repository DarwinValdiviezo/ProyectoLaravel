<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('bodega'), 403);

        $request->validate(['nombre' => 'required']);
        Categoria::create($request->only('nombre'));

        return redirect()->route('categorias.index');
    }

    public function edit(Categoria $categoria)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);
    return view('categorias.edit', compact('categoria'));
}

public function update(Request $request, Categoria $categoria)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);

    $request->validate(['nombre' => 'required']);
    $categoria->update(['nombre' => $request->nombre]);

    return redirect()->route('categorias.index');
}

public function destroy(Categoria $categoria)
{
    abort_unless(auth()->user()->hasRole('bodega'), 403);
    $categoria->delete();

    return redirect()->route('categorias.index');
}

}
