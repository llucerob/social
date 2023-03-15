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


    }

    public function destroymedidas(string $id){

    }
 
    //CONTROLADORES PARA CATEGORIAS

    public function listacategorias(){

    }
    public function createcategorias(){

    }

    public function storecategorias(Request $request){


    }

    public function destroycategorias(string $id){
        
    }

    //CONTROLADORES PARA SECTORES

    public function listasectores(){

    }
    public function createsectores(){

    }

    public function storesectores(Request $request){


    }

    public function destroysectores(string $id){
        
    }
}
