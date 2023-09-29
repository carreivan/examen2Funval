<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;



Route::resource('productos', ProductoController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('compras', CompraController::class);
Route::resource('ventas', VentaController::class);
