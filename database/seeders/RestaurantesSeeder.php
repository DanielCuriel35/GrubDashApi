<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cloudinary\Cloudinary;

class RestaurantesSeeder extends Seeder
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

        $restaurantes = [
            [
                'usuario_id'  => 1,
                'nombreLocal' => 'La Parrilla de Don Julio',
                'img_local'   => public_path('upload/img/restaurantes/restaurante1.jpeg'),
                'precioMedio' => '12€-20€',
                'descripcion' => 'Especialidad en carnes argentinas a la parrilla.',
                'localidad'   => 'Navalmoral de la mata',
                'ubicacion'   => 'Guatemala 4699, Palermo',
            ],
            [
                'usuario_id'  => 2,
                'nombreLocal' => 'Mar y Tierra',
                'img_local'   => public_path('upload/img/restaurantes/restaurante2.jpeg'),
                'precioMedio' => '10€-15€',
                'descripcion' => 'Pescados y mariscos frescos con vista al río.',
                'localidad'   => 'Navalmoral de la mata',
                'ubicacion'   => 'Av. Costanera 1220',
            ],
            [
                'usuario_id'  => 3,
                'nombreLocal' => 'Veggie Vibes',
                'img_local'   => public_path('upload/img/restaurantes/restaurante3.jpeg'),
                'precioMedio' => '8€-14€',
                'descripcion' => 'Restaurante 100% vegano con opciones sin gluten.',
                'localidad'   => 'Navalmoral de la mata',
                'ubicacion'   => 'Belgrano 230',
            ],
            [
                'usuario_id'  => 4,
                'nombreLocal' => 'Pasta e Basta',
                'img_local'   => public_path('upload/img/restaurantes/restaurante4.jpeg'),
                'precioMedio' => '20€-30€',
                'descripcion' => 'Cocina italiana artesanal, pastas caseras.',
                'localidad'   => 'Navalmoral de la mata',
                'ubicacion'   => 'San Martín 145',
            ],
            [
                'usuario_id'  => 5,
                'nombreLocal' => 'Sushi Urban',
                'img_local'   => public_path('upload/img/restaurantes/restaurante5.jpeg'),
                'precioMedio' => '40€-50€',
                'descripcion' => 'Fusión japonesa con ingredientes locales.',
                'localidad'   => 'Navalmoral de la mata',
                'ubicacion'   => 'Av. Del Bicentenario 567',
            ],
        ];

        foreach ($restaurantes as &$restaurante) {
            $uploaded = $cloudinary->uploadApi()->upload($restaurante['img_local'], [
                'folder' => 'restaurantes_seeders',
            ]);

            $restaurante['img'] = $uploaded['secure_url'];

            unset($restaurante['img_local']);

            $restaurante['created_at'] = now();
            $restaurante['updated_at'] = now();
        }

        DB::table('restaurantes')->insert($restaurantes);
    }
}
