<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $hidden = ['pivot'];
    protected $fillable = ['nombre','descripcion'];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'ingrediente_productos', 'ingrediente_id', 'producto_id');
    }
}
