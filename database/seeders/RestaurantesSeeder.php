<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurantes')->insert([
            [
                'usuario_id'   => 1,
                'nombreLocal'  => 'La Parrilla de Don Julio',
                'img'          => 'img/restaurantes/restaurante1.jpeg',
                'precioMedio'  => '12€-20€',
                'descripcion'  => 'Especialidad en carnes argentinas a la parrilla.',
                'localidad'    => 'Navalmoral de la mata',
                'ubicacion'    => 'Guatemala 4699, Palermo',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'usuario_id'   => 2,
                'nombreLocal'  => 'Mar y Tierra',
                'img'          => 'img/restaurantes/restaurante2.jpeg',
                'precioMedio'  => '10€-15€',
                'descripcion'  => 'Pescados y mariscos frescos con vista al río.',
                'localidad'    => 'Navalmoral de la mata',
                'ubicacion'    => 'Av. Costanera 1220',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'usuario_id'   => 3,
                'nombreLocal'  => 'Veggie Vibes',
                'img'          => 'img/restaurantes/restaurante3.jpeg',
                'precioMedio'  => '8€-14€',
                'descripcion'  => 'Restaurante 100% vegano con opciones sin gluten.',
                'localidad'    => 'Navalmoral de la mata',
                'ubicacion'    => 'Belgrano 230',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'usuario_id'   => 4,
                'nombreLocal'  => 'Pasta e Basta',
                'img'          => 'img/restaurantes/restaurante4.jpeg',
                'precioMedio'  => '20€-30€',
                'descripcion'  => 'Cocina italiana artesanal, pastas caseras.',
                'localidad'    => 'Navalmoral de la mata',
                'ubicacion'    => 'San Martín 145',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'usuario_id'   => 5,
                'nombreLocal'  => 'Sushi Urban',
                'img'          => 'img/restaurantes/restaurante5.jpeg',
                'precioMedio'  => '40€-50€',
                'descripcion'  => 'Fusión japonesa con ingredientes locales.',
                'localidad'    => 'Navalmoral de la mata',
                'ubicacion'    => 'Av. Del Bicentenario 567',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
