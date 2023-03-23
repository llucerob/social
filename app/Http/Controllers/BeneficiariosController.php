<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiario;
use App\Models\Registrosocial;
use App\Models\Sector;
use App\Models\Material;
use Carbon\Carbon;
use FontLib\Table\Type\post;
use PDF;

class BeneficiariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiario = Beneficiario::all();

        return view('beneficiarios.listar-beneficiarios', ['beneficiarios' => $beneficiario]);
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
        
        $beneficiario->nombres      = $request->nombres;
        $beneficiario->apellidos    = $request->apellidos;
        $beneficiario->rut          = $request->rut;
        $beneficiario->fnac          = $request->fnac;
        $beneficiario->direccion    = $request->direccion;
        $beneficiario->sector       = $request->sector;
        $beneficiario->telefono     = $request->telefono;
        $beneficiario->correo       = $request->correo;

        

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





        return redirect()->route('beneficiarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beneficiario = Beneficiario::findOrFail($id);

        $beneficiario->delete();

        return redirect()->route('beneficiarios.index');
    }

    public function modificaporcentaje(string $id, Request $request){

        $registrosocial = Registrosocial::findOrFail($id);

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

        $lista = [];

        foreach($request->material as $key => $m){
            
            $beneficiario->solicitudes()->attach($m['id'], ['cantidad' => $m['cantidad'], 'medida' => $m['medida']]);

            $material = Material::findOrFail($m['id']);
            $lista[$key]['nombre']      =   $material->nombre;
            $lista[$key]['cantidad']    =   $m['cantidad'];
            $lista[$key]['medida']      =   $m['medida'];

        }
        
            
        $arr = [];

        $arr['nombre']       =   $beneficiario->nombres;
        $arr['apellido']     =   $beneficiario->apellidos;
        $arr['rut']          =   $beneficiario->rut;
        $arr['direccion']    =   $beneficiario->direccion;
        $arr['sector']       =   $beneficiario->sector;        
        $arr['telefono']     =   $beneficiario->telefono;
        $arr['correo']       =   $beneficiario->correo;
        
        $arr['lista']        =  $lista;
        
        
        /*view()->share('solicitud', $arr);

        $pdf = PDF::loadView('pdfs.solicitud', $arr);


        $pdf->stream('solicitud'.$beneficiario->rut.'.pdf');*/


        view()->share('solicitud', $arr);

        $pdf = PDF::loadView('pdfs.solicitud', $arr);
        return $pdf->download('solicitud'.$arr['nombre'].'.pdf');
       
        
    }

    public function marco(){
        
        


    }



}
