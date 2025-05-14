<?php

use App\Http\Controllers\LlibreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValoracionsController;
use Illuminate\Support\Facades\Route;
use App\Models\Llibre;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $llibreDestacat = Llibre::inRandomOrder()->first();
    return view('welcome', [
        'llibreDestacat' => $llibreDestacat,
        'backgroundImage' => $llibreDestacat?->imatge ?? null
    ]);
});
Route::get('/registar', [UserController::class, 'registar'])->name('users.register');
Route::post('/registat', [UserController::class, 'registrat'])->name('users.registrat');


Route::get('/dashboard', function () {
    return redirect('llibres');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/llibres', [LlibreController::class, 'index'])->name('crud.index');
    // Ruta per veure un llibre.
    Route::get('/llibre/show/{id}', [LlibreController::class, 'show'])->name('crud.show')->middleware('edat');

    Route::get('/valoracions/create/{llibre}/{usuari}', [ValoracionsController::class, 'create']);
    Route::post('/valoracions/new', [ValoracionsController::class, 'new'])->name('valoracions.new');

    Route::middleware(['auth', 'admin'])->group(function () {
        // Rutes per als llibres.   
        // Ruta per mostrar el formulari de creació d'un llibre
        Route::get('/llibre/create', [LlibreController::class, 'create'])->name('crud.create');

        // Ruta per processar la creació del llibre i redirigir a la vista de confirmació
        Route::post('/llibre/new', [LlibreController::class, 'new'])->name('crud.new');

        // Ruta per editar un llibre.
        Route::get('/llibre/edit/{id}', [LlibreController::class, 'edit'])->name('crud.edit');

        // Ruta per mostrar el formulari d'edició d'un llibre.
        Route::put('/llibre/update/{id}', [LlibreController::class, 'update'])->name('crud.update');

        // Ruta per eliminar un llibre.
        Route::delete('/llibre/delete/{id}', [LlibreController::class, 'delete'])->name('crud.delete');

        // Rutes per a les categories.
        // Ruta per veure les categories.
        Route::get('/categories/gestio', [CategoryController::class, 'manage'])->name('category.manage');

        // Ruta per mostrar una categoria.
        Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');

        // Ruta per crear una categoria.
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');

        // Ruta per mostrar el formulari de creació d'una categoria.
        Route::post('/category/new', [CategoryController::class, 'new'])->name('category.new');

        // Ruta per editar una categoria.
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');

        // Ruta per mostrar el formulari d'edició d'una categoria.
        Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');

        // Ruta per eliminar una categoria.
        Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

        // Rutes per a la gestió d'usuaris.
        Route::get('/user/create', [UserController::class, 'create'])->name('users.create');

        // Ruta per crear un nou usuari.
        // Ruta per mostrar el formulari de creació d'un nou usuari.
        Route::post('/user/new', [UserController::class, 'new'])->name('users.new');
        // Ruta per veure els usuaris.
        Route::get('/users/gestio', [UserController::class, 'manage'])->name('users.manage');
        // Ruta per editar un usuari.
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        // Ruta per mostrar el formulari d'edició d'un usuari.
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
        // Ruta per eliminar un usuari.
        Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    });
});

require __DIR__ . '/auth.php';
