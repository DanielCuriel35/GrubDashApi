<?php

namespace App\Models;

use App\Http\Controllers\PedidoProductoController;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombreProducto',
        'img',
        'precio',
        'tiempoPreparacion',
        'descripcion',
        'restaurante_id',
        'ingredientes',
    ];
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'ingrediente_productos', 'producto_id', 'ingrediente_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(
            Pedido::class,
            'pedido_productos',
            'producto_id',
            'pedido_id'
        )->withPivot('cantidad', 'precio_unitario')->withTimestamps();
    }
}
