<?php

use App\Http\Controllers\EventListController;
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

// Redirigir por defecto a la ruta de la API
Route::get('/', function () {
    return redirect()->route('events.showEvent');
});

// Rutas de la API para eventos
Route::get('/eventsAPI', [EventListController::class, 'index'])->name('events.showEvent');

