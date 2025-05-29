<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'user_id',
        'total'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
