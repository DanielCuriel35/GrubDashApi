<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Conexión a la base de datos exitosa.";
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});
