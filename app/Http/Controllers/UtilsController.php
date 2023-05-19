<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Categoria;
use App\Models\Medida;
use App\Models\Beneficiario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\Entregado;
use Illuminate\Database\Eloquent\Builder;




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


    public function dashboard(){

        $beneficiarios = Beneficiario::all();

        $sectores = Sector::all();


        return view('dashboard', ['beneficiarios' => $beneficiarios, 'sectores' => $sectores]);

    }

    public function imprimesectores(Request $request){

        
        $ciclos = count($request->sectores);

        $beneficiarios = Beneficiario::Wherein('sector',$request->sectores)->get();
        $arr = [];
        
        //dd($beneficiarios);

        foreach($beneficiarios as $r => $b){


            //dd($b->entregados->last()->created_at);
            if(count($b->solicitudes) > 0){

                $lista = [];

                    $arr[$r]['nombre']       =   $b->nombres;
                    $arr[$r]['apellido']     =   $b->apellidos;
                    $arr[$r]['rut']          =   $b->rut;
                    $arr[$r]['direccion']    =   $b->direccion;
                    $arr[$r]['sector']       =   $b->sector;        
                    $arr[$r]['telefono']     =   $b->telefono;
                    $arr[$r]['correo']       =   $b->correo;
                    if(count($b->entregados) == 0){ 
                        $arr[$r]['ultimaentrega'] = 'no registra entrega';
                        }else{
                        $arr[$r]['ultimaentrega'] = Carbon::createFromFormat('Y-m-d H:i:s', $b->entregados->last()->entregados->created_at)->format('d-m-Y');
                            
                        }

            
                foreach($b->solicitudes as $key => $d){
                    if($d->solicitudes->domicilio == 1){

                        $lista[$key]['nombre']      = $d->nombre;
                        $lista[$key]['cantidad']    = $d->solicitudes->cantidad;
                        $lista[$key]['medida']      = $d->solicitudes->medida;
                    }

                }
                $arr[$r]['productos']       =   $lista;
                
            }
        }

        //dd($arr);

        view()->share('domicilio', $arr);

        $pdf = PDF::loadView('pdfs.domicilio', $arr)->setPaper('letter','landscape');
        return $pdf->download('domicilio.pdf');

        


    }



    public function crearnomina(){


        $categorias = Categoria::all();

        return view('transparencia.selector-mes', ['categorias' => $categorias]);
    }


    public function transparenciaseleccion(Request $request){

        $categoria = $request->ayuda;

        $entregados = Entregado::whereYear('created_at', $request->ano)
                                ->whereMonth('created_at', $request->mes)
                                ->wherehas('material', function(Builder $query) use($categoria){
                                    $query->where('categoria_id', '=', $categoria);
                                })
                                ->get();
        $arr = [];
        
        foreach($entregados as $key => $e){

            $arr[$key]['ano']       = $e->created_at->locale('es')->isoFormat(('MMMM'));
            $arr[$key]['mes']       = $e->created_at->locale('es')->isoFormat('Y');
            $arr[$key]['nombre']    = $e->beneficiario->nombres;
            $apellido = explode(" ", $e->beneficiario->apellidos);
            $arr[$key]['paterno']   = $apellido[0];
            $arr[$key]['materno']   = $apellido[1];

        }


        //dd($arr);

        return view('transparencia.transparencia', ['entregados' => $arr]);
    }


}
