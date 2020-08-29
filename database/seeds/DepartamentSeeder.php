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
        $departaments = new Departament();
        $departaments->nombre = "Sistema";
        $departaments->cantidad_de_empleados = 1;
        $departaments->save();
    }
}
