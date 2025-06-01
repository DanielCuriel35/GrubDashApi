<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';
    protected $casts = [
        'tieneRestaurante' => 'boolean',
    ];
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nac',
        'username',
        'localidad',
        'direccion',
        'email',
        'password',
        'restaurante',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function restaurantes()
    {
        return $this->hasOne(Restaurante::class, 'usuario_id');
    }
}
