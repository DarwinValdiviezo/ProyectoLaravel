<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->hasRole('cajera'), 403);
        $ventas = Venta::with('detalles.producto')->where('user_id', auth()->id())->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        abort_unless(auth()->user()->hasRole('cajera'), 403);
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasRole('cajera'), 403);

        $request->validate([
            'productos' => 'required|array',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'required|array',
            'cantidades.*' => 'integer|min:1',
        ]);

        $venta = Venta::create(['user_id' => auth()->id()]);

        foreach ($request->productos as $index => $producto_id) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto_id,
                'cantidad' => $request->cantidades[$index],
            ]);
        }

        return redirect()->route('ventas.index');
    }
}
