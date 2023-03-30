<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeneficiariosController;
use App\Http\Controllers\MaterialesController;
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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', [UtilsController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware('auth')->group(function () {

    //CONTROLADORES MATERIALES
    Route::get('materiales/listar', [MaterialesController::class, 'index'])->name('materiales.index');
    Route::get('materiales/crear', [MaterialesController::class, 'create'])->name('materiales.create');
    Route::post('materiales/guardar', [MaterialesController::class, 'store'])->name('materiales.store');
    Route::get('materiales/destroy/{id}', [MaterialesController::class, 'destroy'])->name('materiales.destroy');
    Route::get('materiales/editar/{id}', [MaterialesController::class, 'edit']);
    Route::post('materiales/update/{id}', [MaterialesController::class, 'update']);
    Route::post('materiales/aumentar/{id}/guardar', [MaterialesController::class, 'storeaumentar']);
  

    
    //CONTROLADPRES BENEFICIARIOS
    Route::get('beneficiarios/listar', [BeneficiariosController::class, 'index'])->name('beneficiarios.index');
    Route::get('beneficiarios/nuevo', [BeneficiariosController::class, 'create'])->name('beneficiarios.create');
    Route::post('beneficiarios/guardar', [BeneficiariosController::class, 'store'])->name('beneficiarios.store');
    Route::get('beneficiarios/destroy/{id}', [BeneficiariosController::class, 'destroy']);
    Route::get('beneficiarios/editar/{id}', [BeneficiariosController::class, 'edit']);
    Route::post('beneficiarios/update/{id}', [BeneficiariosController::class, 'update'])->name('beneficiarios.update');
    Route::post('beneficiarios/porcentaje/{id}/modificar', [BeneficiariosController::class, 'modificaporcentaje' ]);
    Route::get('beneficiarios/solicitar/{id}', [BeneficiariosController::class, 'solicitar']);
    Route::post('beneficiarios/solicitar/{id}/parte1', [BeneficiariosController::class, 'solicitudparte1']);
    Route::post('beneficiarios/solicitar/{id}/parte2', [BeneficiariosController::class, 'solicitudparte2']);
    Route::get('beneficiario/{id}/imprimir', [BeneficiariosController::class, 'imprimir'])->name('imprimir', '{id}');
    Route::get('beneficiario/{id}/ver', [BeneficiariosController::class, 'show']);
    Route::get('beneficiario/{id}/entregarmaterial', [BeneficiariosController::class, 'entregarmaterial']);
    Route::get('material/entregar/{m}', [BeneficiariosController::class, 'entregar'])->name('entregar.material');
    Route::post('beneficiario/{id}/creardevolucion', [BeneficiariosController::class, 'creadevolucion'])->name('crear.devolucion');
    Route::get('beneficiarios/listar/devoluciones', [BeneficiariosController::class, 'listardevoluciones'])->name('listar.devoluciones');
    Route::get('beneficiario/aceptar/rendicion/{id}', [BeneficiariosController::class, 'aceptarendicion'])->name('acepta.rendicion');
    Route::get('beneficiario/eliminar/rendicion/{id}', [BeneficiariosController::class, 'eliminarrendicion'])->name('eliminar.rendicion');
    Route::post('beneficiario/agregar/boleta/{id}', [BeneficiariosController::class, 'agregarboleta'])->name('agregar.boleta');
    Route::get('beneficiario/ver/boletas/{id}', [BeneficiariosController::class, 'verboletas'])->name('ver.boletas');
    Route::get('beneficiario/{id}/verpedidos', [BeneficiariosController::class, 'verpedidos'])->name('ver.pedidos');

    //datatables
    Route::get('datatable/beneficiarios', [BeneficiariosController::class, 'ajaxbeneficiarios'])->name('datatable.beneficiarios');





    
    //CONTROLADORES UTILIDADES

    Route::get('utils/medidas', [UtilsController::class, 'medidas'])->name('medidas');
    Route::post('utils/medidas/guardar', [UtilsController::class, 'storemedidas'])->name('medidas.store');
    Route::get('utils/medidas/destroy/{id}', [UtilsController::class, 'destroymedidas']);

    Route::get('utils/categorias', [UtilsController::class, 'categorias'])->name('categorias');
    Route::post('utils/categorias/guardar', [UtilsController::class, 'storecategorias'])->name('categorias.store');
    Route::get('utils/categorias/destroy/{id}', [UtilsController::class, 'destroycategorias']);
    
    Route::get('utils/sectores', [UtilsController::class, 'sectores'])->name('sectores');
    Route::post('utils/sectores/guardar', [UtilsController::class, 'storesectores'])->name('sectores.store');
    Route::get('utils/sectores/destroy/{id}', [UtilsController::class, 'destroysectores']);

    

    


});




