<?php

use Illuminate\Database\Seeder;
use App\Departament;
class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $departamentInformations=[
            [
                'nombre'=>'Sistema',
                'cantidad_de_empleados'=>1,
            ],
            [
                'nombre'=>'Recursos Humanos',
                'cantidad_de_empleados'=>0
            ],
            [
                'nombre'=>'Contabilidad',
                'cantidad_de_empleados'=>0
            ]
        ];
        foreach($departamentInformations as $departamentInformation){
        $departaments = new Departament();
        $departaments->nombre =$departamentInformation['nombre'];
        $departaments->cantidad_de_empleados = $departamentInformation['cantidad_de_empleados'];
        $departaments->save();
        }
    }
}
