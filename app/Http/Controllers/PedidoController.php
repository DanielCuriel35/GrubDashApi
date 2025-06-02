<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Pedido_producto;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    public function aniadirProducto(Request $request)
    {
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');
        $usuario_id = $request->input('usuario_id');

        $producto = Producto::findOrFail($productoId);
        $pedido = Pedido::where('usuario_id', $usuario_id)
            ->where('estado', 'En proceso')
            ->first();

        // Si ya hay un pedido en proceso
        if ($pedido) {
            // Obtener el primer producto del pedido
            $primerProducto = Pedido_producto::where('pedido_id', $pedido->id)->first();

            if ($primerProducto) {
                $productoExistente = Producto::find($primerProducto->producto_id);

                if ($productoExistente->restaurante_id !== $producto->restaurante_id) {
                    return response()->json([
                        'message' => 'Todos los productos del pedido deben ser del mismo restaurante'
                    ], 400);
                }
            }

            // Agregar o actualizar producto
            $pedido_producto = Pedido_producto::where('pedido_id', $pedido->id)
                ->where('producto_id', $producto->id)
                ->first();

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
            // No hay pedido: se puede crear
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

    public function pasarAPendiente(Request $request)
    {
        $usuarioId = $request->input('usuario_id');

        // Buscar el pedido "En proceso" del usuario
        $pedido = Pedido::where('usuario_id', $usuarioId)
            ->where('estado', 'En proceso')
            ->first();

        if (!$pedido) {
            return response()->json(['message' => 'No hay pedido en proceso para este usuario'], 404);
        }

        // Cambiar el estado a 'Pendiente'
        $pedido->estado = 'Pendiente';
        $pedido->save();

        return response()->json(['message' => 'Estado del pedido cambiado a pendiente'], 200);
    }


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
