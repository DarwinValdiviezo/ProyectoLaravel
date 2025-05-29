<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Http\Requests\VentaRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['detalles.producto'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::where('stock', '>', 0)->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(VentaRequest $request)
    {
        try {
            DB::beginTransaction();

            $venta = new Venta();
            $venta->user_id = auth()->id();
            $venta->total = 0;
            $venta->save();

            $total = 0;
            $productos = $request->input('productos');
            $cantidades = $request->input('cantidades');

            foreach ($productos as $index => $productoId) {
                $producto = Producto::findOrFail($productoId);
                $cantidad = $cantidades[$index];

                if ($producto->stock < $cantidad) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Stock insuficiente para el producto {$producto->nombre}. Stock disponible: {$producto->stock}");
                }

                $detalle = new DetalleVenta();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $productoId;
                $detalle->cantidad = $cantidad;
                $detalle->precio_unitario = $producto->precio;
                $detalle->subtotal = $cantidad * $producto->precio;
                $detalle->save();

                $producto->stock -= $cantidad;
                $producto->save();

                $total += $detalle->subtotal;
            }

            $venta->total = $total;
            $venta->save();

            DB::commit();
            return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }
}
