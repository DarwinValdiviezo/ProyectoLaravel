<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
protected $fillable = ['nombre', 'precio', 'stock', 'categoria_id'];

public function categoria()
{
    return $this->belongsTo(Categoria::class);
}
}
