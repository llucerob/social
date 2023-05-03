<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\Registrosocial;
use App\Models\Sector;
use App\Models\Material;
use App\Models\Entregado;
use App\Models\Solicitud;
use App\Models\Reembolso;
use App\Models\Boleta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;



class BeneficiariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiario = Beneficiario::all();

             
       
        //dd(Carbon::parse($b->fnac)->age);

        return view('beneficiarios.listar-beneficiarios', ['beneficiarios' => $beneficiario]);
    }

    public function ajaxbeneficiarios(){


        $ben = Beneficiario::all();
        $arr = [];

        foreach($ben  as $key => $b ){

            if($b->fallecido == 'V'){
            
            $arr[$key]['rut']                   = $b->rut;
            $arr[$key]['nombre']                = $b->nombres.' '.$b->apellidos.' ('.Carbon::parse($b->fnac)->age.' Años)';

            if($b->registrosocial->updated_at == null){
                $arr[$key]['registrosocial']    = $b->registrosocial->folioid.' ('.$b->registrosocial->porcentaje.'% Fecha: '.$b->registrosocial->fechainforme.')';
            }else{
                $arr[$key]['registrosocial']    = $b->registrosocial->folioid.' ('.$b->registrosocial->porcentaje.'% Fecha: '.date_format($b->registrosocial->updated_at, 'd-m-Y').')';

            }
            
            $arr[$key]['direccion']             = $b->direccion.' ,'.$b->sector;
            $arr[$key]['id']                    = $b->id;
            $arr[$key]['idficha']               = $b->registrosocial->id;
            $arr[$key]['porcentaje']            = $b->registrosocial->porcentaje;
        }

        }

           // dd($arr);
        
        return DataTables($arr)->tojson();


        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sectores = Sector::all();
        
        return view('beneficiarios.nuevo-beneficiario', ['sector' => $sectores]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $beneficiario = new Beneficiario;
        
        $beneficiario->nombres          = $request->nombres;
        $beneficiario->apellidos        = $request->apellidos;
        $beneficiario->rut              = $request->rut;
        $beneficiario->fnac             = $request->fnac;
        $beneficiario->direccion        = $request->direccion;
        $beneficiario->sector           = $request->sector;
        $beneficiario->telefono         = $request->telefono;
        $beneficiario->grupofamiliar    = $request->grupofam;
        $beneficiario->correo           = $request->correo;

        

        $registrosocial = Registrosocial::all();

        foreach ($registrosocial as $r){

            if($r->folioid == $request->registrosocial){
                $r->porcentaje = $request->porcentaje;
                $r->update();
                $beneficiario->registrosociales_id = $r->id;


            }

        }


        if(empty($beneficiario->registrosociales_id)){
            
            $registro               = new Registrosocial;
            $registro->folioid      = $request->registrosocial;
            $registro->porcentaje   = $request->porcentaje;
            $registro->save();
            $beneficiario->registrosociales_id = $registro->id;


        }

        $beneficiario->save();





        return redirect()->route('beneficiarios.index')->with('success', 'Se ha creado un nuevo beneficiario' );
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beneficiario   = Beneficiario::findOrFail($id);
        $sector         =    Sector::all();

        return view('beneficiarios.editar-beneficiario', ['beneficiario' => $beneficiario, 'sector' => $sector]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $beneficiario = Beneficiario::findOrFail($id);

        $beneficiario->nombres          = $request->nombres;
        $beneficiario->apellidos        = $request->apellidos;
        $beneficiario->rut              = $request->rut;
        $beneficiario->fnac             = $request->fnac;
        $beneficiario->direccion        = $request->direccion;
        $beneficiario->sector           = $request->sector;
        $beneficiario->telefono         = $request->telefono;
        $beneficiario->correo           = $request->correo;
        $beneficiario->grupofamiliar    = $request->grupofam;

        //dd($beneficiario->registrosocial);

        $registrosocial = Registrosocial::all();

        
        $r = DB::table('registrosociales')->where('folioid', $request->registrosocial)->first();

        //dd($r->id);

       
        
        if(isset($request->registro)){
            if(isset($r)){

                $registro               = Registrosocial::findOrFail($r->id);

                $registro->folioid      = $request->registrosocial;
                $registro->porcentaje   = $request->porcentaje;
                $registro->update();
                $beneficiario->registrosociales_id = $r->id; 

            }else{
                $registro               = new Registrosocial;
                $registro->folioid      = $request->registrosocial;
                $registro->porcentaje   = $request->porcentaje;
                $registro->save();
                $beneficiario->registrosociales_id = $registro->id;

            }              
        }
        

        $beneficiario->update();





        return redirect()->route('beneficiarios.index')->with('success', 'Se ha actualizado el beneficiario' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beneficiario = Beneficiario::findOrFail($id);

        
        $beneficiario->delete();

        return redirect()->route('beneficiarios.index')->with('success', 'Se ha eliminado el beneficiario' );
    }

    public function modificaporcentaje(Request $request){

        $registrosocial = Registrosocial::findOrFail($request->registro);

        $registrosocial->porcentaje = $request->porcentaje;

        $registrosocial->update();

        return redirect()->route('beneficiarios.index');

    }

    public function solicitar(string $id){

        $materiales     = Material::all();
        $beneficiario   = Beneficiario::findOrFail($id);

        return view('solicitudes.solicitar-material', ['materiales' => $materiales, 'beneficiario' => $beneficiario]);

    }

    public function solicitudparte1(string $id, Request $request){

        
        $seleccionados = [];
        

        foreach( $request->materiales as $key => $m )
        {
          
            $material  = Material::findOrFail($m);
            
            if(is_null($request->emergencia)){
                $seleccionados[$key]['id']        = $material->id;
                $seleccionados[$key]['nombre']    = $material->nombre;
                $seleccionados[$key]['limite']    = $material->limite;
                $seleccionados[$key]['medida']    = $material->medida;
                
            }else{

                $seleccionados[$key]['id']        = $material->id;  
                $seleccionados[$key]['nombre']    = $material->nombre;
                $seleccionados[$key]['limite']    = $material->limiteurgencia;
                $seleccionados[$key]['medida']    = $material->medida;
                
            }
        
        }
        $beneficiario = Beneficiario::findOrFail($id);



        return view('solicitudes.solicitar-material-2', ['seleccionados' => $seleccionados, 'emergencia' => $request->emergencia, 'beneficiario' => $beneficiario]);

    }
    public function solicitudparte2(string $id, Request $request){
        $beneficiario = Beneficiario::findOrFail($id);

        //dd($beneficiario);

        

        foreach($request->material as $key => $m){
            if($request->domicilio == 'on'){
                $beneficiario->solicitudes()->attach($m['id'], ['cantidad' => $m['cantidad'], 'medida' => $m['medida'], 'domicilio' => '1', 'comentario' => $request->comentario ]);
                
            }else{
                $beneficiario->solicitudes()->attach($m['id'], ['cantidad' => $m['cantidad'], 'medida' => $m['medida'], 'domicilio' => '0', 'comentario' => $request->comentario ]);
            }
            
           

        }
        
            
       
        return redirect()->route('dashboard')->with('success', 'Solicitud creada correctamente' );
       
        
    }

    public function imprimir(string $id){

             

        $beneficiario = Beneficiario::findOrFail($id);

        if(count($beneficiario->solicitudes) > 0 ){

       

        $arr = [];

        $arr['nombre']       =   $beneficiario->nombres;
        $arr['apellido']     =   $beneficiario->apellidos;
        $arr['rut']          =   $beneficiario->rut;
        $arr['direccion']    =   $beneficiario->direccion;
        $arr['sector']       =   $beneficiario->sector;        
        $arr['telefono']     =   $beneficiario->telefono;
        $arr['correo']       =   $beneficiario->correo;


        $lista = [];
        

        foreach($beneficiario->solicitudes as $key => $b){

           $lista[$key]['nombre']   = $b->nombre;
           $lista[$key]['cantidad'] = $b->solicitudes->cantidad;
           $lista[$key]['medida']   = $b->solicitudes->medida;
           $arr['fechasolicitud']   = $b->solicitudes->created_at;
           $arr['domicilio']        = $b->solicitudes->domicilio;
           
        }
        
        $arr['productos']           =  $lista;
        
        view()->share('solicitud', $arr);

        $pdf = PDF::loadView('pdfs.solicitud', $arr);
        return $pdf->download('solicitud'.$arr['rut'].'.pdf');

        }else{




            return redirect()->route('beneficiarios.index')->with('info', 'El Beneficiario no tiene ningún pedido en sistema' );
        }


    }

    public function entregarmaterial(string $id){

        $beneficiario = Beneficiario::findOrFail($id);

        

        return view('solicitudes.listar-solicitud', ['beneficiario' => $beneficiario]);

    }

    public function entregar(string $m){


        $solicitud  = Solicitud::findOrFail($m);

        $material   = Material::findOrFail($solicitud->materiales_id);    

        $entregado  = new Entregado;

        $entregado->materiales_id   = $solicitud->materiales_id;
        $entregado->beneficiario_id = $solicitud->beneficiario_id;
        $entregado->cantidad        = $solicitud->cantidad;
        $entregado->medida          = $solicitud->medida;
        $entregado->domicilio       = $solicitud->domicilio;
        $entregado->comentario      = $solicitud->comentario;

        $entregado->save();

        $material->stock     =   $material->stock - $solicitud->cantidad;

        $material->update();




        $solicitud->delete();


        
        

        return redirect()->back()->with('success', 'Entrega realizada correctamente' );;
    }

    public function creadevolucion(Request $request){

        $beneficiario       = Beneficiario::findOrFail($request->idusuario);


        $reembolso      =   new Reembolso;

        $reembolso->beneficiarios_id    = $beneficiario->id;

        $reembolso->total               = $request->devolucion;
        $reembolso->mes                 = $request->mes;

        $reembolso->save();


        return redirect()->back()->with('success', 'Se ha creado una nueva devolucion' );



    }

    public function listardevoluciones(){

        $reembolso = Reembolso::all();
        
        return view('devoluciones.listar-devoluciones', ['reembolso' => $reembolso]);
    }

    public function aceptarendicion(string $id){

        $reembolso = Reembolso::findOrFail($id);

        $reembolso->entregado = 1;

        $reembolso->update();

        return redirect()->back();

    }

    public function eliminarrendicion(string $id){

        $reembolso = Reembolso::findOrfail($id);

        $reembolso->delete();

        return redirect()->back();
    }

    public function agregarboleta(string $id , Request $request){

        $boleta = new Boleta;

        if($request->file('boleta')){
            $ruta = Storage::disk('public')->put('boletas', $request->file('boleta'));

            $boleta->reembolsos_id  = $id;
            $boleta->ruta           = $ruta;
            $boleta->valor          = $request->valor;
            $boleta->detalle        = $request->comentario;
            $boleta->save();

            //aqui voy

            $rendicion = Reembolso::findorfail($id);

            $rendicion->suma = $rendicion->suma + $request->valor;
            $rendicion->update();



            return redirect()->back(); 
        }


        return redirect()->back();
        

        
    }

    public function verboletas(string $id){


        $r = Reembolso::findOrFail($id);

        
        return view('devoluciones.listar-boletas', ['rendicion' => $r]);

    }


    public function verpedidos(string $id){

        $beneficiario = Beneficiario::findOrFail($id);



        return view('beneficiarios.listar-solicitudes', ['beneficiario' => $beneficiario]);


    }

    public function fallecer(Request $request){

        $beneficiario = Beneficiario::findOrFail($request->idusuario);

        $beneficiario->fallecido = 'F';

        $beneficiario->update();

        return redirect()->route('beneficiarios.index')->with('success', 'El Beneficiario'.$beneficiario->nombres.' '.$beneficiario->apellidos.' se ha marcado como fallecido');
    }


}
