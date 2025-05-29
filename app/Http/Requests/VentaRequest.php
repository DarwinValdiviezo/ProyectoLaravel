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
            'productos.*.id' => ['required', 'exists:productos,id'],
            'productos.*.cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $productoId = $this->input(str_replace('.cantidad', '.id', $attribute));
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
            'productos.*.id.required' => 'El ID del producto es requerido',
            'productos.*.id.exists' => 'El producto seleccionado no existe',
            'productos.*.cantidad.required' => 'La cantidad es requerida',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero',
            'productos.*.cantidad.min' => 'La cantidad mínima es 1',
        ];
    }
} 