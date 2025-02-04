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
use App\Models\CuentaBancaria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use App\Models\Comentario;
use App\Models\Situacion;




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
            $arr[$key]['comentario']            = $b->comentario;
            $arr[$key]['idficha']               = $b->registrosocial->id;
            $arr[$key]['porcentaje']            = $b->registrosocial->porcentaje;

           
            
        }

        }

           //dd($arr);
        
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
        $beneficiario->comentario       = $request->comentario;

        

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
        $beneficiario->comentario       = $request->comentario;

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





        return redirect()->back()->with('success', 'Se ha actualizado el beneficiario' );
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
                $beneficiario->solicitudes()->attach($m['id'], ['cantidad' => $m['cantidad'], 'medida' => $m['medida'], 'domicilio' => '1', 'comentario' => $request->comentario, 'atendido' => auth()->user()->name]);
                
            }else{
                $beneficiario->solicitudes()->attach($m['id'], ['cantidad' => $m['cantidad'], 'medida' => $m['medida'], 'domicilio' => '0', 'comentario' => $request->comentario, 'atendido' => auth()->user()->name]);
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
           $arr['atendido']         = $b->solicitudes->atendido;
           
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

    public function entregar(Request $request){


        //dd($request->material);

        foreach($request->material as $m){
            $solicitud  = Solicitud::findOrFail($m);
            $material   = Material::findOrFail($solicitud->materiales_id);  
            
            $entregado  = new Entregado;

            $entregado->materiales_id   = $solicitud->materiales_id;
            $entregado->beneficiario_id = $solicitud->beneficiario_id;
            $entregado->cantidad        = $solicitud->cantidad;
            $entregado->medida          = $solicitud->medida;
            $entregado->domicilio       = $solicitud->domicilio;
            $entregado->comentario      = $solicitud->comentario;
            $entregado->atendido        = $solicitud->atendido;
    
            $entregado->save();
    
            $material->stock     =   $material->stock - $solicitud->cantidad;
    
            $material->update();

            if($solicitud->comentario != null){
                $beneficiario = Beneficiario::findOrFail($solicitud->beneficiario_id);
                $beneficiario->comentario = $entregado->comentario; 
                $beneficiario->update();
            }
            
            $solicitud->delete();    

        }    

        return redirect()->back()->with('success', 'Entrega realizada correctamente' );
    }

    public function devolver(Request $request){


        //dd($request->material);

        foreach($request->material as $m){
            $solicitud  = Solicitud::findOrFail($m);
               
            $solicitud->delete();
    



        }        
        

        return redirect()->route('dashboard')->with('success', 'Se han eliminado las solicitudes correctamente' );;
    }

    public function devolvermaterial($id){
        $beneficiario = Beneficiario::findOrFail($id);

        return view('solicitudes.listar-solicitud-entrega', ['beneficiario' => $beneficiario]);

    }

    public function creadevolucion(Request $request){

        //$beneficiario       = Beneficiario::findOrFail($request->idusuario);


        $reembolso      =   new Reembolso;

        $reembolso->beneficiarios_id    = $request->idusuario;
        $reembolso->motivo              = $request->motivo;
        $reembolso->boleta              = str_replace(' ', '-//-',$request->boleta);
        $reembolso->tipoprestacion      = $request->tipoprestacion;

        $reembolso->total               = $request->devolucion;
        
        $reembolso->save();


        return redirect()->route('listar.devoluciones')->with('success', 'Se ha creado una nueva devolucion' );



    }

    public function listardevoluciones(){

        $reembolso = Reembolso::all();
        
        return view('devoluciones.listar-devoluciones', ['reembolso' => $reembolso]);
    }

    public function aceptarendicion(string $id){

        $reembolso = Reembolso::findOrFail($id);

        $reembolso->entregado = '1';

        $reembolso->update();

        

        return redirect()->route('listar.devoluciones');

    }

    public function eliminarrendicion(string $id){

        $reembolso = Reembolso::findOrfail($id);

        $reembolso->delete();

        return redirect()->back();
    }

    public function agregarcuenta(string $id , Request $request){

        $cuenta = new CuentaBancaria;

        $beneficiario = Beneficiario::findOrFail($id);

        $cuenta->beneficiario_id    = $beneficiario->id;
        $cuenta->banco              = $request->banco; 
        $cuenta->tipocuenta         = $request->tipocuenta;   
        $cuenta->numerocuenta       = $request->cuenta;
        $cuenta->save();
 
        return redirect()->back()->with('success', 'Se agregó la cuenta bancaria correctamente');
         
    }
    public function crearnominareembolsos(){


        $reembolsos = Reembolso::where('entregado','2')->get();

        $arr = [];

        foreach($reembolsos as $key => $r){
            $arr[$key] = $r->solicitud;
        }

            //dd(array_unique($arr));
        

        return view('devoluciones.selector-decreto', ['lista' => array_unique($arr)]);
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

    public function historiaxficha(string $id){
        $fichaSocial = RegistroSocial::findOrFail($id);

        dd($fichaSocial->beneficiarios[0]);

    }

    public function imprimerendicion(string $id){


        $rendicion = Reembolso::findOrFail($id);

        $arr    = [];
        
        
        $arr['nombre']      = $rendicion->beneficiario->nombres;
        $arr['apellidos']   = $rendicion->beneficiario->apellidos;
        $arr['rut']         = $rendicion->beneficiario->rut;
        $arr['direccion']   = $rendicion->beneficiario->direccion;
        $arr['sector']      = $rendicion->beneficiario->sector;
        $arr['telefono']    = $rendicion->beneficiario->telefono;
        $arr['correo']      = $rendicion->beneficiario->correo;

        $arr['monto']       = $rendicion->total;
        $arr['motivo']      = $rendicion->motivo;
        $arr['boleta']      = $rendicion->boleta;
        
        $arr['creacion']    = date_format($rendicion->created_at, 'd-m-Y');


        //dd($arr);

        view()->share('rendicion', $arr);

        $pdf = PDF::loadView('pdfs.rendicion', $arr);
        return $pdf->download('rendicion'.$rendicion->id.'.pdf');

    }

    public function generardecretoreembolso(Request $request){
        $reembolso = Reembolso::all();

        foreach($reembolso as $r){
            if($r->entregado  == 1){
                $r->entregado = '2';
                $r->solicitud = $request->decreto;
                $r->update();
            }
        }

        return redirect()->back();
    }

    public function transparenciareembolso(Request $request){

        $reembolsos = Reembolso::where('solicitud', $request->lista)->get();

        $arr = [];

        foreach($reembolsos as $key => $r){
            $arr[$key]['rut']       = $r->beneficiario->rut;
            $arr[$key]['nombre']    = $r->beneficiario->nombres.' '.$r->beneficiario->apellidos; 
            $arr[$key]['mail']      = 'jfuenzalida@municoinco.cl';
            $arr[$key]['banco']     = $r->beneficiario->cuenta->banco;
            $arr[$key]['formapago'] = $r->beneficiario->cuenta->tipocuenta;
            $arr[$key]['numerocuenta']  = $r->beneficiario->cuenta->numerocuenta;
            $arr[$key]['monto']     = $r->total;
        }

        
        //dd($reembolsos[0]->beneficiario->cuenta);



        return view('devoluciones.crear-nomina', ['reembolso' => $arr, 'decreto' => $request->lista]);
    }

    public function aceptadecreto($decreto){
        
        $reembolsos = Reembolso::where('solicitud', $decreto)->get();

        //entregado en 2 = transferencia;
        //entregado en 3 = decreto correcto;
        //entregado en 4 = decreto con fallas;
        
        foreach($reembolsos as $r){
            $r->entregado = '3';
            $r->update();
        }

        return redirect()->route('crear.nominareembolsos')->with('success', 'Nómina marcada como correcta');

    }
    public function rechazadecreto($decreto, Request $request){
        
        $reembolsos = Reembolso::where('solicitud', $decreto)->get();


        //entregado en 2 = transferencia;
        //entregado en 3 = decreto correcto;
        //entregado en 4 = decreto con fallas;
        
        foreach($reembolsos as $r){
            $r->entregado = '4';
            $r->update();
        }

        $comentario = new Comentario;
        $comentario->decreto = $decreto;
        $comentario->comentario = $request->comentario;

        $comentario->save();



        return redirect()->route('crear.nominareembolsos')->with('success', 'Nómina marcada para rectificación');

    }

    public function aportesfallas($decreto){
        $reembolso = Reembolso::where('entregado', '4')->get();

        if($decreto == 'sin-decreto'){
          

            $arr = [];

            foreach($reembolso as $key => $r){
                $arr[$key] = $r->solicitud;
            }

           
        


            return view('devoluciones.listar-rectificaciones', ['reembolso' => 'sinregistro', 'lista' => array_unique($arr), 'comentarios' => null, 'decreto' => $decreto]);

        }else{

            $arr = [];

            foreach($reembolso as $key => $r){
                $arr[$key] = $r->solicitud;
            }
            $reembolso = Reembolso::where('solicitud', $decreto)->get();

            $comentarios = Comentario::where('decreto', $decreto)->get();




            return view('devoluciones.listar-rectificaciones', ['reembolso' => $reembolso, 'lista' => array_unique($arr) , 'comentarios' => $comentarios, 'decreto' => $decreto]);



        }
        

    }

    public function editarcuenta($id, Request $request){
        $beneficiario = Beneficiario::findOrFail($id);


        $beneficiario->cuenta->banco                = $request->banco;
        $beneficiario->cuenta->tipocuenta           = $request->tipocuenta;
        $beneficiario->cuenta->numerocuenta         = $request->cuenta;

        $beneficiario->cuenta->update();

        return redirect()->back();



    }


    public function reenviadecreto($decreto){

        $reembolso = Reembolso::where('solicitud', $decreto)->get();

        foreach($reembolso as $r){
            $r->entregado = '2';
            $r->update();
        }


        return redirect()->route('listar.devoluciones')->with('se ha reenviado la nómina');



    }

    public function storesituacion(Request $request, $id){

        $situacion = new Situacion;

        $situacion->beneficiario_id = $id;
        $situacion->tipo            = $request->tipo;
        $situacion->comentario      = $request->comentario;


        $situacion->save();


        return redirect()->back();



    }

    public function crearfichainterna(string $id){

        $beneficiario = Beneficiario::findOrFail($id);

        $arr    = [];
        
        
        $arr['nombre']      = $beneficiario->nombres;
        $arr['apellido']   = $beneficiario->apellidos;
        $arr['rut']         = $beneficiario->rut;
        $arr['direccion']   = $beneficiario->direccion;
        $arr['sector']      = $beneficiario->sector;
        $arr['telefono']    = $beneficiario->telefono;
        $arr['correo']      = $beneficiario->correo;
        $arr['fecha']       = date_format(now(), 'd-m-Y');
        $arr['atendido']    = auth()->user()->name;

        $arr['registrosocial']          = $beneficiario->registrosocial->folioid;
        $arr['porcentaje']              = $beneficiario->registrosocial->porcentaje;
       
        $familiar = [];
        $salud = [];
        foreach($beneficiario->situaciones as $key => $s){

            if($s->tipo == 'familiar'){
                $familiar[$key]['fecha']      = date_format($s->created_at, 'd-m-Y');
                $familiar[$key]['comentario'] = $s->comentario;
            }elseif($s->tipo == 'salud'){
                $salud[$key]['fecha']         = date_format($s->created_at, 'd-m-Y');
                $salud[$key]['comentario']    = $s->comentario;
            }

             
         }
         
         $arr['salud']      = $salud;
         $arr['familiar']   = $familiar;



        //dd($arr);

        view()->share('ficha', $arr);

        $pdf = PDF::loadView('pdfs.ficha', $arr);
        return $pdf->download('fichaMunicipal'.$arr['rut'].'.pdf');


    }



}
