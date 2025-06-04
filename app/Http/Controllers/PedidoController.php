<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pedido_producto;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Función que sirve para añadir un producto al pedido
    public function aniadirProducto(Request $request)
    {
        //Recibo todos los parametros atraves del body
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');
        $usuario_id = $request->input('usuario_id');

        $producto = Producto::findOrFail($productoId);
        //Busco los pedidos que esten en proceso
        $pedido = Pedido::where('usuario_id', $usuario_id)
            ->where('estado', 'En proceso')
            ->first();

        if ($pedido) {
            //Si existe un pedido en proceso compruebo que tenga producto
            $primerProducto = Pedido_producto::where('pedido_id', $pedido->id)->first();

            if ($primerProducto) {
                //En caso de tener producto compruebo el id de su restaurante para evitar que se pueda añadir
                //un producto con restaurante diferente
                $productoExistente = Producto::find($primerProducto->producto_id);

                if ($productoExistente->restaurante_id !== $producto->restaurante_id) {
                    return response()->json([
                        'message' => 'Todos los productos del pedido deben ser del mismo restaurante'
                    ], 400);
                }
            }

            $pedido_producto = Pedido_producto::where('pedido_id', $pedido->id)
                ->where('producto_id', $producto->id)
                ->first();
            //Aumento la cantidad si el pedido ya tiene ese producto guardado y si no lo añado
            if ($pedido_producto) {
                $pedido_producto->cantidad += $cantidad;
                $pedido_producto->save();
            } else {
                $pedido_producto = new Pedido_producto();
                $pedido_producto->pedido_id = $pedido->id;
                $pedido_producto->producto_id = $producto->id;
                $pedido_producto->cantidad = $cantidad;
                $pedido_producto->precio_unitario = $producto->precio;
                $pedido_producto->save();
            }

            return response()->json(['message' => 'Producto añadido al pedido'], 200);
        } else {
            //Si el pedido no existia lo creo
            $pedido = new Pedido();
            $pedido->usuario_id = $usuario_id;
            $pedido->estado = 'En proceso';
            $pedido->save();

            $pedido_producto = new Pedido_producto();
            $pedido_producto->pedido_id = $pedido->id;
            $pedido_producto->producto_id = $producto->id;
            $pedido_producto->cantidad = $cantidad;
            $pedido_producto->precio_unitario = $producto->precio;
            $pedido_producto->save();

            return response()->json(['message' => 'Pedido creado y producto añadido'], 200);
        }
    }

    //Función que elimina un producto del pedido
    public function eliminarProducto(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $producto_id = $request->input('producto_id');

        $pedido = Pedido::where('usuario_id', $usuario_id)
            ->where('estado', 'En proceso')
            ->orderBy('fecha_pedido', 'desc')
            ->first();

        if (!$pedido) {
            return response()->json(['message' => 'No existe un pedido en proceso para este usuario'], 404);
        }

        $pedido_producto = Pedido_producto::where('pedido_id', $pedido->id)
            ->where('producto_id', $producto_id)
            ->first();

        if (!$pedido_producto) {
            return response()->json(['message' => 'El producto no está en el pedido'], 404);
        }

        $pedido_producto->delete();

        return response()->json(['message' => 'Producto eliminado del pedido'], 200);
    }


    //Función que recupera todos los pedidos de un usuario que no esten en proceso
    public function pedidosPorUsuario($usuarioId)
    {
        $pedidos = Pedido::with(['productos.restaurante'])
            ->where('usuario_id', $usuarioId)
            ->where('estado', '<>', 'En proceso')
            ->orderBy('fecha_pedido', 'desc')
            ->get();

        $resultado = $pedidos->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'fecha_pedido' => $pedido->fecha_pedido,
                'estado' => $pedido->estado,
                'restaurante' => [
                    'id' => optional($pedido->productos->first()->restaurante)->id,
                    'nombre' => optional($pedido->productos->first()->restaurante)->nombreLocal,
                ],
                'productos' => $pedido->productos->map(function ($producto) {
                    return [
                        'id' => $producto->id,
                        'nombre' => $producto->nombreProducto,
                        'cantidad' => $producto->pivot->cantidad,
                        'precio_unitario' => $producto->pivot->precio_unitario,
                    ];
                }),
            ];
        });


        return response()->json($resultado);
    }

    //Función que sirve para pasar pedidos a pendientes y que cambien de la página carrito a la pagina de pedidos
    public function pasarAPendiente(Request $request)
    {
        $usuarioId = $request->input('usuario_id');

        $pedido = Pedido::where('usuario_id', $usuarioId)
            ->where('estado', 'En proceso')
            ->first();

        if (!$pedido) {
            return response()->json(['message' => 'No hay pedido en proceso para este usuario'], 404);
        }

        $pedido->estado = 'Pendiente';
        $pedido->save();

        return response()->json(['message' => 'Estado del pedido cambiado a pendiente'], 200);
    }

    //Función que sirve para mostrar el pedido que esta en proceso
    public function pedidoCarrito($usuarioId)
    {
        $pedido = Pedido::with(['productos.restaurante'])
            ->where('usuario_id', $usuarioId)
            ->where('estado', 'En proceso')
            ->first();

        if (!$pedido) {
            return response()->json(null);
        }

        $resultado = [
            'id' => $pedido->id,
            'fecha_pedido' => $pedido->fecha_pedido,
            'estado' => $pedido->estado,
            'restaurante' => [
                'id' => optional($pedido->productos->first()->restaurante)->id,
                'nombre' => optional($pedido->productos->first()->restaurante)->nombreLocal,
            ],
            'productos' => $pedido->productos->map(function ($producto) {
                return [
                    'id' => $producto->id,
                    'nombre' => $producto->nombreProducto,
                    'cantidad' => $producto->pivot->cantidad,
                    'precio_unitario' => $producto->pivot->precio_unitario,
                    'img' => asset($producto->img),
                ];
            }),
        ];

        return response()->json($resultado);
    }


    //Función que recupera todos los pedidos de un usuario que no esten en preparación
    public function pedidosPorRest($restauranteId)
    {
        $pedidos = Pedido::whereHas('productos', function ($query) use ($restauranteId) {
            $query->where('restaurante_id', $restauranteId);
        })->get();

        $resultado = $pedidos->map(function ($pedido) {
            return [
                'id' => $pedido->id,
                'fecha_pedido' => $pedido->fecha_pedido,
                'estado' => $pedido->estado,
                'restaurante' => [
                    'id' => optional($pedido->productos->first()->restaurante)->id,
                    'nombre' => optional($pedido->productos->first()->restaurante)->nombreLocal,
                ],
                'productos' => $pedido->productos->map(function ($producto) {
                    return [
                        'id' => $producto->id,
                        'nombre' => $producto->nombreProducto,
                        'cantidad' => $producto->pivot->cantidad,
                        'precio_unitario' => $producto->pivot->precio_unitario,
                    ];
                }),
            ];
        });


        return response()->json($resultado);
    }

    //Función que permite al restaurante actualizar el estado de los pedidos
    public function actualizarEstado($id, Request $request)
    {
        $request->validate([
            'estado' => 'required|in:enviado,entregado',
        ]);

        $pedido = Pedido::find($id);

        if (! $pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $pedido->estado = $request->estado;
        $pedido->save();

        return response()->json([
            'message' => 'Estado actualizado correctamente',
            'pedido' => $pedido
        ]);
    }
}
