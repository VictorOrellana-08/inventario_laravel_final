<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ResponsablesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(
    [
        "middleware" => [
            "auth"
        ]
    ],
    function () {

        #API
        Route::prefix("api")
            ->group(function () {

                // Áreas
                Route::get('areas', [AreasController::class, 'mostrar'])->name('areas');
                Route::get('areas/buscar/{busqueda}', [AreasController::class, 'buscar'])->name('areas');
                Route::delete('area/{id}', [AreasController::class, 'eliminar']);
                Route::post('areas/eliminar', [AreasController::class, 'eliminarMuchas']);

                // Responsables
                Route::post('/responsable', [ResponsablesController::class, 'agregar']);
                Route::get('responsables', [ResponsablesController::class, 'mostrar']);
                Route::get('responsable/{id}', [ResponsablesController::class, 'porId']);
                Route::get('responsables/buscar/{busqueda}', [ResponsablesController::class, 'buscar']);
                Route::delete('responsable/{id}', [ResponsablesController::class, 'eliminar']);
                Route::post('responsables/eliminar', [ResponsablesController::class, 'eliminarMuchos']);
                Route::put('responsable/', [ResponsablesController::class, 'guardarCambios'])->name('guardarCambiosDeResponsable');
                
                // Artículos
                Route::post('/articulo', [ArticulosController::class, 'agregar']);
                Route::get('/articulos', [ArticulosController::class, 'mostrar']);
                Route::get('articulo/{id}', [ArticulosController::class, 'porId']);
                Route::put('articulo/', [ArticulosController::class, 'guardarCambios'])->name('guardarCambiosDeResponsable');
                
                // Fotos de artículos
                Route::post('eliminar/foto/articulo/', [ArticulosController::class, 'eliminarFoto'])->name('eliminarFotoDeArticulo');
            });

        # VISTAS
        Route::get('areas/pdf', [AreasController::class, 'pdf'])->name('pdf');
        Route::view("areas/agregar", "agregar_area")->name("formularioArea");
        Route::get('areas/editar/{id}', [AreasController::class, 'editar'])->name('formularioEditarArea');
        Route::view('areas/', [AreasController::class, 'areas'])->name('areas');

        # Otras cosas
        Route::post('areas/agregar', [AreasController::class, 'agregar'])->name('guardarArea');
        Route::put('area/', [AreasController::class, 'guardarCambios'])->name('guardarCambiosDeArea');
        Route::get('foto/articulo/{nombre}', [ArticulosController::class, 'foto'])->name('fotoDeArticulo');
        Route::get('descargar/foto/artiuclo/{nombre}', [ArticulosController::class, 'descargar'])->name('descargarFotoDeArticulo');

        //-------------------------------
        // Responsables
        //-------------------------------
        Route::get('responsables/pdf', [ResponsablesController::class, 'pdf'])->name('responsables.pdf');
        Route::view("responsables/agregar", "responsables/agregar")->name("formularioAgregarResponsable");
        Route::view("responsables/", "responsables/mostrar")->name("responsables");
        Route::view('responsables/editar/{id}', [ResponsablesController::class, 'responsables/editar'])->name('formularioEditarResponsable');

        //-------------------------------
        // Artículos
        //-------------------------------
        Route::get('articulos/pdf', [ArticulosController::class, 'pdf'])->name('articulos.pdf');
        Route::view("articulos/agregar", "articulos.agregar")->name("formularioAgregarArticulo");
        Route::view("articulos/", "articulos/mostrar")->name("articulos");
        Route::view("articulos/editar/{id}", "articulos/editar")->name("formularioEditarArticulo");
        Route::get('articulos/fotos/{id}', [ArticulosController::class, 'administrarFotos'])->name('administrarFotos');
        Route::get('articulos/eliminar/{id}', [ArticulosController::class, 'vistaDarDeBaja'])->name('vistaDarDeBajaArticulo');
        Route::post('articulos/fotos', [ArticulosController::class, 'agregarFotos'])->name('agregarFotosDeArticulo');
        Route::post('articulos/eliminar', [ArticulosController::class, 'eliminar'])->name('eliminarArticulo');
    }
);