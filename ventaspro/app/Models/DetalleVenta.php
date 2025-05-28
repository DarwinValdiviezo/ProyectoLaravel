<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
protected $fillable = ['venta_id', 'producto_id', 'cantidad'];

public function producto()
{
    return $this->belongsTo(Producto::class);
}
}
