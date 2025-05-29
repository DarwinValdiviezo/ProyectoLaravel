<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        // Datos para admin y secre
        if (auth()->user()->hasRole(['admin', 'secre'])) {
            $data['usuarios'] = User::with('roles')->get();
        }

        // Datos para bodega
        if (auth()->user()->hasRole('bodega')) {
            $data['categorias'] = Categoria::all();
            $data['productos'] = Producto::with('categoria')->get();
        }

        // Datos para cajera - solo sus propias ventas
        if (auth()->user()->hasRole('cajera')) {
            $data['ventas'] = Venta::with(['detalles.producto'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('dashboard', $data);
    }
} 