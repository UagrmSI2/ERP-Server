<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $rolenames=[
            "Administrador",
            "Encargado Venta",
            "Encargado Compra",
            "Encargado Almacen"
        ];
        foreach($rolenames as $roleName){
        $roles = new Role();
        $roles->name = $roleName;
        $roles->save();
        }
    }
}
