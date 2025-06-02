<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Carlos',
                'apellido' => 'Ramírez',
                'fecha_nac' => '1990-05-12',
                'username' => 'carlosr',
                'localidad' => 'Navalmoral de la mata',
                'direccion' => 'Calle Falsa 123',
                'email' => 'carlos@example.com',
                'password' => Hash::make('password123'),
                'restaurante' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María',
                'apellido' => 'Gómez',
                'fecha_nac' => '1985-11-23',
                'username' => 'mariag',
                'localidad' => 'Navalmoral de la mata',
                'direccion' => 'Av. Siempre Viva 456',
                'email' => 'maria@example.com',
                'password' => Hash::make('segura456'),
                'restaurante' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Lucía',
                'apellido' => 'Fernández',
                'fecha_nac' => '1992-08-30',
                'username' => 'luciaf',
                'localidad' => 'Navalmoral de la mata',
                'direccion' => 'Las Heras 789',
                'email' => 'lucia@example.com',
                'password' => Hash::make('lucia789'),
                'restaurante' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Julián',
                'apellido' => 'Martínez',
                'fecha_nac' => '1988-03-15',
                'username' => 'julianm',
                'localidad' => 'Navalmoral de la mata',
                'direccion' => 'Mitre 321',
                'email' => 'julian@example.com',
                'password' => Hash::make('clavejulian'),
                'restaurante' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'López',
                'fecha_nac' => '1995-07-20',
                'username' => 'ana01',
                'localidad' => 'Navalmoral de la mata',
                'direccion' => 'Belgrano 654',
                'email' => 'ana@example.com',
                'password' => Hash::make('ana2024'),
                'restaurante' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
