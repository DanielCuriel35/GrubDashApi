<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $fillable = [
        'usuario_id',
        'nombreLocal',
        'img',
        'precioMedio',
        'descripcion',
        'localidad',
        'ubicacion',
        'tipoRest'
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
