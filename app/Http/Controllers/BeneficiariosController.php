<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiario;

class BeneficiariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beneficiario = Beneficiario::all();

        return view('beneficiarios.listarbeneficiarios', ['beneficiarios' => $beneficiario]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $beneficiario = new Beneficiario;
        
        $beneficiario->nombres      = $request->nombres;
        $beneficiario->apellidos    = $request->apellidos;
        $beneficiario->direccion    = $request->direccion;
        $beneficiario->sector       = $request->sector;
        $beneficiario->telefono     = $request->telefono;
        $beneficiario->correo       = $request->correo;

        $beneficiario->save();


        return redirect('dashboard');
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
        //
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
        //
    }
}
