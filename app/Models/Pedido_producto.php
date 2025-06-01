<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido_producto extends Model
{
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
