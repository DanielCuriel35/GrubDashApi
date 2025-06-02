<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientesProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['producto_id' => 1, 'ingrediente_id' => 1],
            ['producto_id' => 1, 'ingrediente_id' => 2],

            ['producto_id' => 2, 'ingrediente_id' => 3],
            ['producto_id' => 2, 'ingrediente_id' => 4],

            ['producto_id' => 3, 'ingrediente_id' => 5],
            ['producto_id' => 3, 'ingrediente_id' => 6],

            ['producto_id' => 4, 'ingrediente_id' => 7],
            ['producto_id' => 4, 'ingrediente_id' => 8],

            ['producto_id' => 5, 'ingrediente_id' => 9],
            ['producto_id' => 5, 'ingrediente_id' => 10],

            ['producto_id' => 6, 'ingrediente_id' => 11],
            ['producto_id' => 6, 'ingrediente_id' => 12],

            ['producto_id' => 7, 'ingrediente_id' => 13],
            ['producto_id' => 7, 'ingrediente_id' => 14],

            ['producto_id' => 8, 'ingrediente_id' => 15],
            ['producto_id' => 8, 'ingrediente_id' => 16],

            ['producto_id' => 9, 'ingrediente_id' => 17],
            ['producto_id' => 9, 'ingrediente_id' => 18],

            ['producto_id' => 10, 'ingrediente_id' => 19],
            ['producto_id' => 10, 'ingrediente_id' => 20],

            ['producto_id' => 11, 'ingrediente_id' => 21],
            ['producto_id' => 11, 'ingrediente_id' => 22],

            ['producto_id' => 12, 'ingrediente_id' => 23],
            ['producto_id' => 12, 'ingrediente_id' => 24],

            ['producto_id' => 13, 'ingrediente_id' => 25],
            ['producto_id' => 13, 'ingrediente_id' => 26],

            ['producto_id' => 14, 'ingrediente_id' => 27],
            ['producto_id' => 14, 'ingrediente_id' => 28],

            ['producto_id' => 15, 'ingrediente_id' => 29],
            ['producto_id' => 15, 'ingrediente_id' => 30],

            ['producto_id' => 16, 'ingrediente_id' => 31],
            ['producto_id' => 16, 'ingrediente_id' => 32],

            ['producto_id' => 17, 'ingrediente_id' => 33],
            ['producto_id' => 17, 'ingrediente_id' => 34],

            ['producto_id' => 18, 'ingrediente_id' => 35],
            ['producto_id' => 18, 'ingrediente_id' => 36],

            ['producto_id' => 19, 'ingrediente_id' => 37],
            ['producto_id' => 19, 'ingrediente_id' => 38],

            ['producto_id' => 20, 'ingrediente_id' => 39],
            ['producto_id' => 20, 'ingrediente_id' => 40],
        ];
    }
}
