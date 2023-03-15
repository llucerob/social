<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeneficiariosController;
use App\Http\Controllers\UtilsController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware('auth')->group(function () {

    //CONTROLADPRES BENEFICIARIOS
    Route::get('beneficiarios/listar', [BeneficiariosController::class, 'index'])->name('beneficiarios.index');
    Route::get('beneficiarios/nuevo', [BeneficiariosController::class, 'create'])->name('beneficiarios.create');
    Route::post('beneficiarios/guardar', [BeneficiariosController::class, 'store'])->name('beneficiarios.store');


    
    //CONTROLADORES UTILIDADES

    Route::get('utils/medidas', [UtilsController::class, 'medidas'])->name('medidas');
   
    Route::get('utils/medidas/guardar', [UtilsController::class, 'storemedidas'])->name('medidas.store');
    Route::get('utils/medidas/destroy', [UtilsController::class, 'destroymedidas'])->name('medidas.destroy');

    Route::get('utils/categorias/listar', [UtilsController::class, 'listacategorias'])->name('categorias.listar');
    Route::get('utils/categorias/nuevo', [UtilsController::class, 'createcategorias'])->name('categorias.create');
    Route::get('utils/categorias/guardar', [UtilsController::class, 'storecategorias'])->name('categorias.store');
    Route::get('utils/categorias/destroy', [UtilsController::class, 'destroycategorias'])->name('categorias.destroy');
    
    Route::get('utils/sectores/listar', [UtilsController::class, 'listasectores'])->name('sectores.listar');
    Route::get('utils/sectores/nuevo', [UtilsController::class, 'createsectores'])->name('sectores.create');
    Route::post('utils/sectores/guardar', [UtilsController::class, 'storesectores'])->name('sectores.store');
    Route::post('utils/sectores/destroy', [UtilsController::class, 'destroysectores'])->name('sectores.destroy');


});




