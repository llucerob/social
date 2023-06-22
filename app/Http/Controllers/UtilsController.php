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
use App\Models\Material;
use App\Models\SolicitudMunicipal;
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


        $arr = [];

        $mat = [];

        foreach($beneficiarios as $key => $b){
            if(count($b->solicitudes) > 0){
                $arr[$key]['id']            = $b->id;
                $arr[$key]['nombre']        = $b->nombres.' '.$b->apellidos;
                $arr[$key]['rut']           = $b->rut;
                $arr[$key]['direccion']     = $b->direccion.', '.$b->sector;
                $arr[$key]['atendido']      = $b->solicitudes->first()->solicitudes->atendido;
                foreach($b->solicitudes as $j => $a){
                    $arr[$key]['materiales'][$j]['nombre']      = $a->solicitudes->cantidad.' '.$a->solicitudes->medida.' de '.$a->nombre;
                    $arr[$key]['materiales'][$j]['domicilio']   = $a->solicitudes->domicilio;
                }
                

            }
            

        }


        $sectores = Sector::all();


        return view('dashboard', ['beneficiarios' => collect($arr)->values()->all(), 'sectores' => $sectores]);

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

    public function creardecreto(){


        $categorias = Categoria::all();

        return view('transparencia.decreto-selector-mes', ['categorias' => $categorias]);
    }


    
    public function decretoseleccion(Request $request){

        $categoria = $request->ayuda;

        $entregados = Entregado::whereYear('created_at', $request->ano)
                                ->whereMonth('created_at', $request->mes)
                                ->wherehas('material', function(Builder $query) use($categoria){
                                    $query->where('categoria_id', '=', $categoria);
                                })
                                ->get();
        $arr = [];
        
        foreach($entregados as $key => $e){

            $arr[$key]['material']       = $e->material->nombre;
            $arr[$key]['cantidad']       = $e->cantidad.' '.$e->medida;
            $arr[$key]['nombre']    = $e->beneficiario->nombres;
            $apellido = explode(' ', $e->beneficiario->apellidos);
            $arr[$key]['paterno']   = $apellido[0];
            if(isset($apellido[1])){
                $arr[$key]['materno']   =  $apellido[1]  ;
                
            }else{
                $arr[$key]['materno']   =  ' '  ;
            }

        }


        //dd($arr);

        return view('transparencia.decreto', ['entregados' => $arr]);
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
            if(isset($apellido[1])){
                $arr[$key]['materno']   =  $apellido[1]  ;
                
            }else{
                $arr[$key]['materno']   =  ' '  ;
            }

        }


        //dd($arr);

        return view('transparencia.transparencia', ['entregados' => $arr]);
    }


    public function solicitudmuni(){

        $materiales = Material::all();


        return view('solicitudes.solicitar-material-municipal', ['materiales' => $materiales]);        
    }

    public function storesolicitudmuni1(Request $request){



        $solicitud = New SolicitudMunicipal;

        $solicitud->motivo      = $request->motivo;
        $solicitud->atendido    = auth()->user()->name;

        $solicitud->save();


        $seleccionados = [];
        

        foreach( $request->materiales as $key => $m )
        {
          
            $material  = Material::findOrFail($m);
            
           
                $seleccionados[$key]['id']        = $material->id;  
                $seleccionados[$key]['nombre']    = $material->nombre;
                $seleccionados[$key]['medida']    = $material->medida;
                $seleccionados[$key]['stock']     = $material->stock;  

   
        }


        return view('solicitudes.solicitar-material-municipal2', ['seleccionados' => $seleccionados, 'solicitud_id' => $solicitud->id]);
        


    }

    public function storesolicitudmuni2(Request $request){


        $solicitud = SolicitudMunicipal::findOrFail($request->solicitud_id);


        foreach($request->material as  $m){

            $solicitud->solicitudmunicipal()->attach($m['id'], ['cantidad' => $m['cantidad'], 'unidad' => $m['medida']]);
            $material   = Material::findOrFail($m['id']);
            $material->stock     =   $material->stock - $m['cantidad'];
            $material->update();

        }


        return redirect()->route('listar.municipal')->with('success', 'Solicitud Municipal creada correctamente' );


        


    }

    public function listarmuni(){


        $solicitudes = SolicitudMunicipal::all();

        return view('solicitudes.listar-municipalidad', ['solicitudes' => $solicitudes]);
    }

    public function reintegrar(String $id){
        $solicitud = SolicitudMunicipal::findOrFail($id);
        //dd($solicitud->solicitudmunicipal);

        

        return view('solicitudes.reintegrar-material', ['solicitud' => $solicitud]);
    }

    public function reintegrarmaterial(String $id, Request $request){

        $solicitud = SolicitudMunicipal::findOrFail($id);
        //dd($request->material);


        foreach($solicitud->solicitudmunicipal as $s){

        }



        foreach($request->material as $m){
            //dd($m['cantidad']);
           
            //dd($solicitud->solicitudmunicipal()->where('material_id', $m['material'])->first()->solicitudmunicipal->cantidad);
            $reintegro = $solicitud->solicitudmunicipal()->where('material_id', $m['material'])->first()->solicitudmunicipal->cantidad - $m['cantidad'];
            
            //dd($reintegro);
            $material  = Material::findOrFail($m['material']);
            $material->stock = $material->stock + $reintegro;
            $material->update(); 

            $solicitud->solicitudmunicipal()->updateExistingPivot($m['material'], ['cantidad' => $m['cantidad']]);
            //$solicitud->save();
        }




        return redirect()->route('listar.municipal')->with('info', ' se ha actualizado la informacion de la solicitud municipal');


        


    }

    public function imprimirmunicipal(String $id){
        
        $solicitud = SolicitudMunicipal::findOrFail($id);

        $arr = [];

        foreach($solicitud->solicitudmunicipal as $key => $b){
            $arr[$key]['material']  = $b->nombre;
            $arr[$key]['cantidad']  = $b->solicitudmunicipal->cantidad;
            $arr[$key]['unidad']    = $b->solicitudmunicipal->unidad;
             
        }

        $s['objetivo']      = $solicitud->motivo;
        $s['fecha']         = $solicitud->created_at;
        $s['atendido']      = $solicitud->atendido;
        $s['materiales']    = $arr;


        view()->share('solicitud', $s);

        $pdf = PDF::loadView('pdfs.solicitud-municipal', $s);
        return $pdf->download('solicitud.pdf');





    }


}
