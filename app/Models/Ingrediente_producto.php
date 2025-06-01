<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente_producto extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
