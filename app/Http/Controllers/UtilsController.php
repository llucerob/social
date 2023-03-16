<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Categoria;
use App\Models\Medida;




class UtilsController extends Controller
{
 
    //CONTROLADORES PARA MEDIDAS

    public function medidas(){

        $medidas = Medida::all();




        return view('utils.medidas', ['medidas' => $medidas]);

    }
    

    public function storemedidas(Request $request){

        $newmedida = new Medida;

        $newmedida->nombreunidad  =   $request->nombre;
        $newmedida->abrv          =   $request->abrv;
        $newmedida->save();


        return redirect()->route('medidas');


    }

    public function destroymedidas(string $id){

        $medida = Medida::findOrFail($id);
        $medida->delete();

        return redirect()->route('medidas');

    }
 
    //CONTROLADORES PARA CATEGORIAS

    public function categorias(){

        $categorias = Categoria::all();

        return view('utils.categorias', ['categorias' => $categorias]);

    }
    

    public function storecategorias(Request $request){
        $newcategoria = new Categoria;

        $newcategoria->nombre          =   $request->nombre;
        $newcategoria->descripcion     =   $request->descripcion;
        $newcategoria->save();


        return redirect()->route('categorias');

    }

    public function destroycategorias(string $id){

        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categorias');
        
    }

    //CONTROLADORES PARA SECTORES

    public function sectores(){
        $sectores = Sector::all();

        return view('utils.sectores', ['sectores' => $sectores]);

    }
   

    public function storesectores(Request $request){

        $newsector = new Sector;

        $newsector->nombre  =   $request->nombre;
        $newsector->save();


        return redirect()->route('sectores');


    }

    public function destroysectores(string $id){

        $sector = Sector::findOrFail($id);
        $sector->delete();

        return redirect()->route('sectores');
        
    }
}
