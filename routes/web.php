<?php

use App\Http\Controllers\CartaController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MisNiniosController;
use App\Http\Controllers\NinioController;
use App\Http\Controllers\ResponderCartaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\Carta;
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




Route::get('manual-de-usuario',[WelcomeController::class,'manual'])->name('manual');
Route::get('privacidad',[WelcomeController::class,'privacidad'])->name('privacidad');

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
    Route::get('cartas-documentos/{id}', [CartaController::class, 'documentos'])->name('cartas.documentos');
    Route::get('cartas-descargar-pdf/{id}', [CartaController::class, 'descargarPdf'])->name('cartas.descargarPdf');
    
    // boletas
    Route::get('ver-boleta-archivo-imagen/{id}', [CartaController::class, 'verBoletaArchivoImagen'])->name('verBoletaArchivoImagen');
    
    
    

});

// reposnder carta niño
Route::get('cartas-ninio/{numero_child}', [ResponderCartaController::class, 'index'])->name('cartas-ninio.index');
Route::get('carta-ninio-ver/{idcarta}/{numero_child}', [ResponderCartaController::class, 'ver'])->name('cartas-ninio.ver');
Route::get('carta-ninio-archivo/{id}/{tipo}', [ResponderCartaController::class, 'verArchivo'])->name('cartas-ninio.ver-archivo');
Route::post('carta-ninio-guardar-contestacion', [ResponderCartaController::class, 'guardarContestacion'])->name('cartas-ninio.guardar-contestacion');
Route::post('carta-ninio-guardar-agradecimiento', [ResponderCartaController::class, 'guardarAgradecimiento'])->name('cartas-ninio.guardar-agradecimiento');
Route::post('carta-ninio-guardar-iniciada', [ResponderCartaController::class, 'guardarIniciada'])->name('cartas-ninio.guardar-iniciada');
Route::post('cartas-ninio.guardar-presentacion-mayor', [ResponderCartaController::class, 'guardarPresentacionMayor'])->name('cartas-ninio.guardar-presentacion-mayor');
Route::post('cartas-ninio.guardar-presentacion-menor', [ResponderCartaController::class, 'guardarPresentacionMenor'])->name('cartas-ninio.guardar-presentacion-menor');



