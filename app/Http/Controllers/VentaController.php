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

            // Crear la venta
            $venta = Venta::create([
                'user_id' => auth()->id(),
                'fecha' => now(),
            ]);

            // Procesar los productos
            foreach ($request->productos as $productoData) {
                $producto = Producto::findOrFail($productoData['id']);
                
                // Verificar stock nuevamente (doble verificación)
                if ($productoData['cantidad'] > $producto->stock) {
                    throw new \Exception("No hay suficiente stock para {$producto->nombre}. Stock disponible: {$producto->stock}");
                }

                // Crear el detalle de la venta
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $productoData['cantidad'],
                    'precio_unitario' => $producto->precio,
                ]);

                // Actualizar el stock
                $producto->decrement('stock', $productoData['cantidad']);
            }

            DB::commit();

            return redirect()->route('ventas.index')
                ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }
}
