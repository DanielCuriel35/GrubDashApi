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
    {
        DB::table('ingredientes')->insert([

            ['nombre' => 'Carne picada', 'descripcion' => 'Carne vacuna picada para empanadas'],
            ['nombre' => 'Huevo duro', 'descripcion' => 'Huevo cocido para el relleno'],

            ['nombre' => 'Bife de chorizo', 'descripcion' => 'Corte de carne jugoso y tierno'],
            ['nombre' => 'Papas fritas', 'descripcion' => 'Papas cortadas y fritas'],

            ['nombre' => 'Queso provolone', 'descripcion' => 'Queso provolone fundido con orégano'],
            ['nombre' => 'Orégano', 'descripcion' => 'Hierba aromática para sazonar'],

            ['nombre' => 'Chorizo', 'descripcion' => 'Chorizo artesanal para asar'],
            ['nombre' => 'Pimienta negra', 'descripcion' => 'Especia para condimentar'],

            ['nombre' => 'Morcilla', 'descripcion' => 'Embutido tradicional con especias'],
            ['nombre' => 'Ajo', 'descripcion' => 'Condimento para saborizar'],

            ['nombre' => 'Arroz', 'descripcion' => 'Arroz para paella'],
            ['nombre' => 'Mariscos variados', 'descripcion' => 'Mejillones, calamares y camarones'],

            ['nombre' => 'Filete de pescado', 'descripcion' => 'Filete fresco para cocinar'],
            ['nombre' => 'Limón', 'descripcion' => 'Jugo y ralladura de limón'],

            ['nombre' => 'Pescado fresco', 'descripcion' => 'Pescado crudo marinado'],
            ['nombre' => 'Cilantro', 'descripcion' => 'Hierba fresca para saborizar'],

            ['nombre' => 'Calamar', 'descripcion' => 'Anillos de calamar fresco'],
            ['nombre' => 'Harina', 'descripcion' => 'Harina para rebozar'],

            ['nombre' => 'Mezcla de mariscos', 'descripcion' => 'Mariscos cocidos variados'],
            ['nombre' => 'Salsa blanca', 'descripcion' => 'Salsa bechamel casera'],

            ['nombre' => 'Quinoa', 'descripcion' => 'Grano andino cocido'],
            ['nombre' => 'Palta', 'descripcion' => 'Palta fresca en cubos'],

            ['nombre' => 'Tofu', 'descripcion' => 'Queso de soja grillado'],
            ['nombre' => 'Verduras salteadas', 'descripcion' => 'Mezcla de verduras frescas'],

            ['nombre' => 'Legumbres', 'descripcion' => 'Base de hamburguesa de lentejas y garbanzos'],
            ['nombre' => 'Pan integral', 'descripcion' => 'Pan para hamburguesa'],

            ['nombre' => 'Tortilla de harina', 'descripcion' => 'Base para el wrap'],
            ['nombre' => 'Vegetales frescos', 'descripcion' => 'Lechuga, tomate y zanahoria'],

            ['nombre' => 'Berenjena', 'descripcion' => 'Rodajas de berenjena asada'],
            ['nombre' => 'Salsa de tomate', 'descripcion' => 'Salsa casera de tomate'],

            ['nombre' => 'Papa', 'descripcion' => 'Puré de papa para ñoquis'],
            ['nombre' => 'Salsa bolognesa', 'descripcion' => 'Salsa con carne y tomate'],

            ['nombre' => 'Carne molida', 'descripcion' => 'Carne vacuna molida'],
            ['nombre' => 'Salsa bechamel', 'descripcion' => 'Salsa blanca cremosa'],

            ['nombre' => 'Mozzarella', 'descripcion' => 'Queso mozzarella fresco'],
            ['nombre' => 'Albahaca', 'descripcion' => 'Hojas frescas de albahaca'],

            ['nombre' => 'Panceta', 'descripcion' => 'Tiras de panceta crocante'],
            ['nombre' => 'Huevo', 'descripcion' => 'Huevos para la salsa'],

            ['nombre' => 'Aceite de oliva', 'descripcion' => 'Aceite extra virgen'],
            ['nombre' => 'Romero', 'descripcion' => 'Hierba fresca de romero'],

            ['nombre' => 'Arroz para sushi', 'descripcion' => 'Arroz de grano corto'],
            ['nombre' => 'Salmón', 'descripcion' => 'Salmón fresco en láminas'],

            ['nombre' => 'Atún fresco', 'descripcion' => 'Lámina de atún fresco'],
            ['nombre' => 'Arroz para sushi', 'descripcion' => 'Arroz de grano corto'],

            ['nombre' => 'Langostinos', 'descripcion' => 'Langostinos frescos'],
            ['nombre' => 'Harina para tempura', 'descripcion' => 'Mezcla para rebozar'],

            ['nombre' => 'Caldo de cerdo', 'descripcion' => 'Caldo preparado con huesos de cerdo'],
            ['nombre' => 'Fideos ramen', 'descripcion' => 'Fideos japoneses para ramen'],

            ['nombre' => 'Masa para gyozas', 'descripcion' => 'Masa fina para empanaditas'],
            ['nombre' => 'Relleno de cerdo', 'descripcion' => 'Carne de cerdo picada y condimentada'],
        ]);
    }
}
