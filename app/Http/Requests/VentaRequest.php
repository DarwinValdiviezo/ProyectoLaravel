<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Producto;

class VentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productos' => ['required', 'array', 'min:1'],
            'productos.*' => ['required', 'exists:productos,id'],
            'cantidades' => ['required', 'array', 'min:1'],
            'cantidades.*' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $productoId = request()->input('productos.' . $index);
                    $producto = Producto::find($productoId);
                    
                    if (!$producto) {
                        $fail('El producto no existe.');
                        return;
                    }

                    if ($value > $producto->stock) {
                        $fail("No hay suficiente stock para {$producto->nombre}. Stock disponible: {$producto->stock}");
                    }
                }
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'productos.required' => 'Debe seleccionar al menos un producto',
            'productos.array' => 'El formato de productos no es válido',
            'productos.min' => 'Debe seleccionar al menos un producto',
            'productos.*.required' => 'El ID del producto es requerido',
            'productos.*.exists' => 'El producto seleccionado no existe',
            'cantidades.required' => 'Las cantidades son requeridas',
            'cantidades.array' => 'El formato de cantidades no es válido',
            'cantidades.min' => 'Debe especificar al menos una cantidad',
            'cantidades.*.required' => 'La cantidad es requerida',
            'cantidades.*.integer' => 'La cantidad debe ser un número entero',
            'cantidades.*.min' => 'La cantidad mínima es 1',
        ];
    }
} 