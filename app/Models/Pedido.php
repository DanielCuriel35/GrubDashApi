<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['estado'];
    
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'pedido_productos',
            'pedido_id',
            'producto_id'
        )->withPivot('cantidad', 'precio_unitario')->withTimestamps();
    }
}
