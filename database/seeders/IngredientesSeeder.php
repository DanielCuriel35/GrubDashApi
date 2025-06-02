<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $ingredientes = [
                ['nombre' => 'Carne', 'descripcion' => 'Carne de res fresca y seleccionada'],
                ['nombre' => 'Cebolla', 'descripcion' => 'Cebolla blanca picada fina'],
                ['nombre' => 'Carne de res', 'descripcion' => 'Corte especial para asados'],
                ['nombre' => 'Pimienta negra', 'descripcion' => 'Pimienta negra molida al momento'],
                ['nombre' => 'Queso mozzarella', 'descripcion' => 'Queso mozzarella fresco'],
                ['nombre' => 'Orégano', 'descripcion' => 'Orégano seco para condimentar'],
                ['nombre' => 'Chorizo', 'descripcion' => 'Chorizo artesanal de cerdo'],
                ['nombre' => 'Ajo', 'descripcion' => 'Ajo fresco y picado'],
                ['nombre' => 'Morcilla', 'descripcion' => 'Morcilla criolla tradicional'],
                ['nombre' => 'Arroz', 'descripcion' => 'Arroz tipo bomba para paellas'],
                ['nombre' => 'Camarones', 'descripcion' => 'Camarones frescos pelados'],
                ['nombre' => 'Pescado', 'descripcion' => 'Filete de pescado fresco'],
                ['nombre' => 'Limón', 'descripcion' => 'Jugo y ralladura de limón fresco'],
                ['nombre' => 'Cilantro', 'descripcion' => 'Hojas frescas de cilantro'],
                ['nombre' => 'Calamar', 'descripcion' => 'Anillos frescos de calamar'],
                ['nombre' => 'Harina de trigo', 'descripcion' => 'Harina para rebozados'],
                ['nombre' => 'Mariscos', 'descripcion' => 'Mezcla de mariscos variados'],
                ['nombre' => 'Quinoa', 'descripcion' => 'Quinoa blanca y orgánica'],
                ['nombre' => 'Palta', 'descripcion' => 'Palta madura en rodajas'],
                ['nombre' => 'Tofu', 'descripcion' => 'Tofu firme y fresco'],
                ['nombre' => 'Aceite de oliva', 'descripcion' => 'Aceite de oliva extra virgen'],
                ['nombre' => 'Legumbres', 'descripcion' => 'Mezcla de legumbres cocidas'],
                ['nombre' => 'Pan', 'descripcion' => 'Pan artesanal fresco'],
                ['nombre' => 'Vegetales', 'descripcion' => 'Variedad de vegetales frescos'],
                ['nombre' => 'Hummus', 'descripcion' => 'Puré de garbanzos y tahini'],
                ['nombre' => 'Berenjena', 'descripcion' => 'Berenjena fresca en rodajas'],
                ['nombre' => 'Papa', 'descripcion' => 'Papas seleccionadas para ñoquis'],
                ['nombre' => 'Queso parmesano', 'descripcion' => 'Queso parmesano rallado'],
                ['nombre' => 'Albahaca', 'descripcion' => 'Hojas frescas de albahaca'],
                ['nombre' => 'Panceta', 'descripcion' => 'Tiras de panceta ahumada'],
                ['nombre' => 'Huevo', 'descripcion' => 'Huevos frescos de granja'],
                ['nombre' => 'Romero', 'descripcion' => 'Ramas frescas de romero'],
            ];

            foreach ($ingredientes as $ingrediente) {
                DB::table('ingredientes')->insert([
                    'nombre' => $ingrediente['nombre'],
                    'descripcion' => $ingrediente['descripcion'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
