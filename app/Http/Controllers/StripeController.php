<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function crearSesionCheckout(Request $request)
    {
        // Configura tu clave secreta de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $productos = $request->input('productos');

        // Mapea productos a line_items de Stripe
        $lineItems = array_map(function ($producto) {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $producto['nombre'],
                        'images' => [$producto['img']],
                    ],
                    'unit_amount' => intval($producto['precio_unitario'] * 100), // en centavos
                ],
                'quantity' => $producto['cantidad'],
            ];
        }, $productos);

        // Crea la sesión de Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'https://tusitio.com/success',
            'cancel_url' => 'https://tusitio.com/cancel',
        ]);

        return response()->json(['id' => $session->id]);
    }
}
