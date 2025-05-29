<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
protected $fillable = [
    'venta_id', 
    'producto_id', 
    'cantidad',
    'precio_unitario',
    'subtotal'
];

public function producto()
{
    return $this->belongsTo(Producto::class);
}
}
