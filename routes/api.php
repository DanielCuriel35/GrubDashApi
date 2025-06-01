<?php

use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('restaurantes/{localidad}', [RestauranteController::class,'show'] );
Route::get('restaurantesU/{idUsuario}', [RestauranteController::class,'restUsuario'] );
Route::post('restaurante', [RestauranteController::class,'store'] );
Route::put('restaurantesUpdate/{id}', [RestauranteController::class, 'update']);

Route::get('productos/{id_restaurante}', [ProductoController::class,'index']);
Route::post('producto', [ProductoController::class,'store'] );
Route::get('Dproducto/{id_producto}', [ProductoController::class, 'show']);
Route::put('productosUpdate/{id}', [ProductoController::class, 'update']);


Route::get('ingredientes', [IngredienteController::class,'index']);
Route::post('ingrediente', [IngredienteController::class,'store'] );

Route::post('registro', [UsuarioController::class,'store'] );
Route::post('login', [UsuarioController::class,'login'] );
Route::put('usuario/{id}', [UsuarioController::class, 'update']);

Route::get('pedidos/{usuarioId}', [PedidoController::class, 'pedidosPorUsuario']);
Route::get('pedidosR/{restauranteId}', [PedidoController::class, 'pedidosPorRest']);
Route::get('pedidosC/{restauranteId}', [PedidoController::class, 'pedidoCarrito']);
Route::put('pedidos/{id}/estado', [PedidoController::class, 'actualizarEstado']);
Route::post('pedido', [PedidoController::class, 'aniadirProducto']);

