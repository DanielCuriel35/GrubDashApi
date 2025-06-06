<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cloudinary\Cloudinary;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $productos = [
            // Restaurante 1
            [
                'restaurante_id' => 1,
                'nombreProducto' => 'Empanadas de carne',
                'img_local' => public_path('upload/img/productos/producto1.jpeg'),
                'precio' => 15,
                'descripcion' => 'Empanadas tradicionales con carne picada y huevo.',
                'tiempoPreparacion' => '15 min',
            ],
            [
                'restaurante_id' => 1,
                'nombreProducto' => 'Bife de chorizo',
                'img_local' => public_path('upload/img/productos/producto2.jpeg'),
                'precio' => 10,
                'descripcion' => 'Corte de carne jugoso, acompañado de papas.',
                'tiempoPreparacion' => '25 min',
            ],
            [
                'restaurante_id' => 1,
                'nombreProducto' => 'Provoleta',
                'img_local' => public_path('upload/img/productos/producto3.jpeg'),
                'precio' => 20,
                'descripcion' => 'Queso provolone fundido con orégano y ají molido.',
                'tiempoPreparacion' => '10 min',
            ],
            [
                'restaurante_id' => 1,
                'nombreProducto' => 'Chorizo a la parrilla',
                'img_local' => public_path('upload/img/productos/producto4.jpeg'),
                'precio' => 40,
                'descripcion' => 'Chorizo artesanal a las brasas.',
                'tiempoPreparacion' => '12 min',
            ],
            [
                'restaurante_id' => 1,
                'nombreProducto' => 'Morcilla',
                'img_local' => public_path('upload/img/productos/producto5.jpeg'),
                'precio' => 34,
                'descripcion' => 'Morcilla criolla, suave y especiada.',
                'tiempoPreparacion' => '12 min',
            ],

            // Restaurante 2
            [
                'restaurante_id' => 2,
                'nombreProducto' => 'Paella de mariscos',
                'img_local' => public_path('upload/img/productos/producto6.jpeg'),
                'precio' => 16,
                'descripcion' => 'Arroz con calamares, mejillones y camarones.',
                'tiempoPreparacion' => '30 min',
            ],
            [
                'restaurante_id' => 2,
                'nombreProducto' => 'Pescado al limón',
                'img_local' => public_path('upload/img/productos/producto7.jpeg'),
                'precio' => 18,
                'descripcion' => 'Filete de pescado con salsa de limón y perejil.',
                'tiempoPreparacion' => '20 min',
            ],
            [
                'restaurante_id' => 2,
                'nombreProducto' => 'Ceviche clásico',
                'img_local' => public_path('upload/img/productos/producto8.jpeg'),
                'precio' => 34,
                'descripcion' => 'Pescado crudo marinado con limón, cebolla y cilantro.',
                'tiempoPreparacion' => '15 min',
            ],
            [
                'restaurante_id' => 2,
                'nombreProducto' => 'Rabas',
                'img_local' => public_path('upload/img/productos/producto9.jpeg'),
                'precio' => 40,
                'descripcion' => 'Anillos de calamar rebozados y fritos.',
                'tiempoPreparacion' => '10 min',
            ],
            [
                'restaurante_id' => 2,
                'nombreProducto' => 'Tarta de mariscos',
                'img_local' => public_path('upload/img/productos/producto10.jpeg'),
                'precio' => 20,
                'descripcion' => 'Tarta con mariscos y salsa blanca casera.',
                'tiempoPreparacion' => '25 min',
            ],

            // Restaurante 3
            [
                'restaurante_id' => 3,
                'nombreProducto' => 'Ensalada de quinoa',
                'img_local' => public_path('upload/img/productos/producto11.jpeg'),
                'precio' => 15,
                'descripcion' => 'Quinoa, palta, tomate y rúcula con vinagreta. ',
                'tiempoPreparacion' => '10 min',
            ],
            [
                'restaurante_id' => 3,
                'nombreProducto' => 'Tofu grillado',
                'img_local' => public_path('upload/img/productos/producto12.jpeg'),
                'precio' => 19,
                'descripcion' => 'Tofu marinado y grillado con verduras salteadas.',
                'tiempoPreparacion' => '15 min',
            ],
            [
                'restaurante_id' => 3,
                'nombreProducto' => 'Hamburguesa vegana',
                'img_local' => public_path('upload/img/productos/producto13.jpeg'),
                'precio' => 28,
                'descripcion' => 'Hecha a base de legumbres y vegetales.',
                'tiempoPreparacion' => '18 min',
            ],
            [
                'restaurante_id' => 3,
                'nombreProducto' => 'Wrap vegetal',
                'img_local' => public_path('upload/img/productos/producto14.jpeg'),
                'precio' => 34,
                'descripcion' => 'Tortilla rellena con vegetales frescos y hummus.',
                'tiempoPreparacion' => '12 min',
            ],
            [
                'restaurante_id' => 3,
                'nombreProducto' => 'Lasaña de berenjena',
                'img_local' => public_path('upload/img/productos/producto15.jpeg'),
                'precio' => 14,
                'descripcion' => 'Capas de berenjena, salsa de tomate y queso vegano.',
                'tiempoPreparacion' => '30 min',
            ],

            // Restaurante 4
            [
                'restaurante_id' => 4,
                'nombreProducto' => 'Ñoquis caseros',
                'img_local' => public_path('upload/img/productos/producto16.jpeg'),
                'precio' => 17,
                'descripcion' => 'Pasta de papa con salsa bolognesa. ',
                'tiempoPreparacion' => '20 min',
            ],
            [
                'restaurante_id' => 4,
                'nombreProducto' => 'Lasagna italiana',
                'img_local' => public_path('upload/img/productos/producto17.jpeg'),
                'precio' => 27,
                'descripcion' => 'Pasta en capas con carne y salsa bechamel.',
                'tiempoPreparacion' => '30 min',
            ],
            [
                'restaurante_id' => 4,
                'nombreProducto' => 'Pizza margherita',
                'img_local' => public_path('upload/img/productos/producto18.jpeg'),
                'precio' => 21,
                'descripcion' => 'Salsa de tomate, mozzarella y albahaca fresca.',
                'tiempoPreparacion' => '15 min',
            ],
            [
                'restaurante_id' => 4,
                'nombreProducto' => 'Spaghetti carbonara',
                'img_local' => public_path('upload/img/productos/producto19.jpeg'),
                'precio' => 26,
                'descripcion' => 'Pasta con panceta, huevo y queso.',
                'tiempoPreparacion' => '20 min',
            ],
            [
                'restaurante_id' => 4,
                'nombreProducto' => 'Focaccia',
                'img_local' => public_path('upload/img/productos/producto20.jpeg'),
                'precio' => 18,
                'descripcion' => 'Pan italiano con aceite de oliva y romero.',
                'tiempoPreparacion' => '25 min',
            ],

            // Restaurante 5
            [
                'restaurante_id' => 5,
                'nombreProducto' => 'Sushi roll de salmón',
                'img_local' => public_path('upload/img/productos/producto21.jpeg'),
                'precio' => 19,
                'descripcion' => 'Roll relleno con salmón y palta. ',
                'tiempoPreparacion' => '20 min',
            ],
            [
                'restaurante_id' => 5,
                'nombreProducto' => 'Nigiri de atún',
                'img_local' => public_path('upload/img/productos/producto22.jpeg'),
                'precio' => 34,
                'descripcion' => 'Arroz moldeado con lámina de atún fresco.',
                'tiempoPreparacion' => '12 min',
            ],
            [
                'restaurante_id' => 5,
                'nombreProducto' => 'Tempura de langostinos',
                'img_local' => public_path('upload/img/productos/producto23.jpeg'),
                'precio' => 22,
                'descripcion' => 'Langostinos rebozados y fritos, crujientes.',
                'tiempoPreparacion' => '15 min',
            ],
            [
                'restaurante_id' => 5,
                'nombreProducto' => 'Ramen clásico',
                'img_local' => public_path('upload/img/productos/producto24.jpeg'),
                'precio' => 23,
                'descripcion' => 'Caldo de cerdo, fideos, huevo y vegetales.',
                'tiempoPreparacion' => '25 min',
            ],
            [
                'restaurante_id' => 5,
                'nombreProducto' => 'Gyozas',
                'img_local' => public_path('upload/img/productos/producto25.jpeg'),
                'precio' => 21,
                'descripcion' => 'Empanaditas japonesas rellenas al vapor y plancha.',
                'tiempoPreparacion' => '10 min',
            ],
        ];

        foreach ($productos as $producto) {
            $uploadResult = $cloudinary->uploadApi()->upload($producto['img_local'], [
                'folder' => 'productos_seeder',
                'overwrite' => true,
            ]);

            DB::table('productos')->insert([
                'restaurante_id' => $producto['restaurante_id'],
                'nombreProducto' => $producto['nombreProducto'],
                'img' => $uploadResult['secure_url'],
                'precio' => $producto['precio'],
                'descripcion' => $producto['descripcion'],
                'tiempoPreparacion' => $producto['tiempoPreparacion'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
