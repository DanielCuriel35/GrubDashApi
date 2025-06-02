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
        {
        $data = [];

        $ingredienteId = 1;

        for ($productoId = 1; $productoId <= 20; $productoId++) {
            $data[] = [
                'producto_id' => $productoId,
                'ingrediente_id' => $ingredienteId++,
            ];
            $data[] = [
                'producto_id' => $productoId,
                'ingrediente_id' => $ingredienteId++,
            ];
        }

        DB::table('ingrediente_productos')->insert($data);
    }
    }
}
