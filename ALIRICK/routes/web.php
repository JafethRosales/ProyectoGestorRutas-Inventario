<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/', 'welcome');

Route::redirect('/', 'dashboard');

Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::view('clientes', 'clientes')
    ->middleware(['auth'])
    ->name('clientes');

Route::view('ventas', 'ventas')
    ->middleware(['auth'])
    ->name('ventas');

Route::view('inventario', 'inventario')
    ->middleware(['auth'])
    ->name('inventario');

Route::view('vehiculo', 'vehiculo')
    ->middleware(['auth'])
    ->name('vehiculo');

Route::view('rutas', 'rutas')
    ->middleware(['auth'])
    ->name('rutas');

Route::view('pagos', 'pagos')
    ->middleware(['auth'])
    ->name('pagos');

Route::view('creditos', 'creditos')
    ->middleware(['auth'])
    ->name('creditos');

Route::view('visitas', 'visitas')
    ->middleware(['auth'])
    ->name('visitas');

Route::view('historial/rutas', 'rutas')
    ->middleware(['auth'])
    ->name('historial.rutas');

Route::view('historial/pagos', 'pagos')
    ->middleware(['auth'])
    ->name('historial.pagos');

Route::view('historial/creditos', 'creditos')
    ->middleware(['auth'])
    ->name('historial.creditos');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
