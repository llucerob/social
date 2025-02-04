<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Material;
use App\Models\Medida;


class MaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiales = Material::all();
        

        

        return view('materiales.listar-materiales', ['materiales' => $materiales]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $medidas    = Medida::all();

        return view('materiales.nuevo-material', ['categorias' => $categorias, 'medidas' => $medidas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newmaterial = new Material;

        $newmaterial->nombre            =   $request->nombre;
        $newmaterial->categoria_id      =   $request->categoria;
        $newmaterial->stock             =   $request->stock;
        $newmaterial->medida            =   $request->medida;
        $newmaterial->limite            =   $request->limite;
        $newmaterial->limiteurgencia    =   $request->limiteurgencia;

        $newmaterial->save();
        
        return redirect()->route('materiales.index');

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
       $material = Material::findOrFail($id);
       $categorias = Categoria::all();
       $medidas = Medida::all();
       

       return view('materiales.editar-material', ['material' => $material, 'categorias' => $categorias, 'medidas' => $medidas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);


        $material->nombre            =   $request->nombre;
        $material->categoria_id      =   $request->categoria;
        
        $material->medida            =   $request->medida;
        $material->limite            =   $request->limite;
        $material->limiteurgencia    =   $request->limiteurgencia;

        $material->update();

        return redirect()->route('materiales.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return redirect()->route('materiales.index');
    }

    public function storeaumentar(string $id, Request $request){
        $material = Material::findOrFail($id);

        $material->stock= $material->stock + $request->stock;
        
        $material->update();

        return redirect()->route('materiales.index');
    }
}
