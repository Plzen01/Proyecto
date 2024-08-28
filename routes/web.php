<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;

Route::get('/', function () {
    return view('publicaciones.index');
});

// Categorías
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/crear', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

// Publicaciones
Route::get('/publicaciones', [PublicacionController::class, 'index'])->name('publicaciones.index');
Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.crear');
Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
Route::get('/publicaciones/{id}', [PublicacionController::class, 'show'])->name('publicacion.show');
Route::get('/publicaciones/{id}/editar', [PublicacionController::class, 'edit'])->name('publicacion.editar');
Route::put('/publicaciones/{id}', [PublicacionController::class, 'update'])->name('publicacion.update');
Route::delete('/publicaciones/{id}', [PublicacionController::class, 'destroy'])->name('publicacion.destroy');

// Comentarios
Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentario.store');
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentario.destroy');
