<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();
        $role->name = 'social';
        $role->descripcion = 'Usuario Social';
        $role->save();  
        
        $role = new Role();
        $role->name = 'admin';
        $role->descripcion = 'Usuario Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'bodega';
        $role->descripcion = 'Usuario Bodega';
        $role->save();
    }
}
