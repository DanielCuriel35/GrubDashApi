<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([

            UsuariosSeeder::class,
            RestaurantesSeeder::class,
            IngredientesSeeder::class,
            ProductosSeeder::class,
            IngredientesProductosSeeder::class,
        ]);
    }
}
