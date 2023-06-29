<?php

use App\Http\Controllers\CartaController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MisNiniosController;
use App\Http\Controllers\NinioController;
use App\Http\Controllers\ResponderCartaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    // Artisan::call('cache:clear');
    // Artisan::call('config:clear');
    // Artisan::call('config:cache');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    // Artisan::call('migrate:fresh --seed');
    return view('welcome');
})->name('welcome');

Route::get('ver-archivo-pdf-por-ninio/{path}',function($path){
    return Storage::get($path);   
})->name('verarchivopdfporninio');


Auth::routes(['register' => false]);




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('validarec', [HomeController::class, 'validarec'])->name('validarec');

    // usuarios
    Route::resource('usuarios', UserController::class);
    // comunidad
    Route::resource('comunidad', ComunidadController::class);
    // ninios
    Route::resource('ninios', NinioController::class);
    Route::get('ninios-importar', [NinioController::class, 'importar'])->name('ninios.importar');
    Route::post('ninios-subir-importar', [NinioController::class, 'subirImportacion'])->name('ninios.subir-importar');
    // gestores
    Route::resource('mis-ninios', MisNiniosController::class);
    // cartas
    Route::resource('cartas', CartaController::class);
    Route::get('cartas-ver-carta-pdf/{id}', [CartaController::class, 'verPDF'])->name('cartas.ver-carta-pdf');
    Route::get('cartas-ver-archivo/{id}/{tipo}', [CartaController::class, 'verArchivo'])->name('cartas.ver-archivo');
    

});

// reposnder carta niño
Route::get('cartas-ninio/{numero_child}', [ResponderCartaController::class, 'index'])->name('cartas-ninio.index');
Route::get('carta-ninio-ver/{idcarta}/{numero_child}', [ResponderCartaController::class, 'ver'])->name('cartas-ninio.ver');
Route::get('carta-ninio-archivo/{id}/{tipo}', [ResponderCartaController::class, 'verArchivo'])->name('cartas-ninio.ver-archivo');
Route::post('carta-ninio-archivo-guardar', [ResponderCartaController::class, 'guardarArchivo'])->name('cartas-ninio.guardar-archivo');
Route::post('cartas-ninio.guardar-presentacion-mayor', [ResponderCartaController::class, 'guardarPresentacionMayor'])->name('cartas-ninio.guardar-presentacion-mayor');
Route::post('cartas-ninio.guardar-presentacion-menor', [ResponderCartaController::class, 'guardarPresentacionMenor'])->name('cartas-ninio.guardar-presentacion-menor');



