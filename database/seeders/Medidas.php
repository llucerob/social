<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medida;

class Medidas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Medida();
        $role->nombreunidad = 'Bolsa';
        $role->abrv = 'bols';
        $role->save(); 

        $role = new Medida();
        $role->nombreunidad = 'Caja';
        $role->abrv = 'caj';
        $role->save(); 

        $role = new Medida();
        $role->nombreunidad = 'Galon';
        $role->abrv = 'gal';
        $role->save(); 

        $role = new Medida();
        $role->nombreunidad = 'Juego';
        $role->abrv = 'jueg';
        $role->save(); 

        $role = new Medida();
        $role->nombreunidad = 'Kilogramos';
        $role->abrv = 'Kg';
        $role->save(); 
        
        $role = new Medida();
        $role->nombreunidad = 'Metros';
        $role->abrv = 'Mts';
        $role->save();
        
        $role = new Medida();
        $role->nombreunidad = 'Par';
        $role->abrv = 'par';
        $role->save(); 
        
        $role = new Medida();
        $role->nombreunidad = 'Carga';
        $role->abrv = 'car';
        $role->save(); 

        $role = new Medida();
        $role->nombreunidad = 'Unidad';
        $role->abrv = 'un';
        $role->save(); 
    }
}
