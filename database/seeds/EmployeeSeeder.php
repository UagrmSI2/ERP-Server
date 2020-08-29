<?php

use Illuminate\Database\Seeder;
use App\Employee;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = new Employee();
        $employee->ci = "9636927";
        $employee->nombre = "Cristian";
        $employee->apellido = "Castro";
        $employee->sexo = "M";
        $employee->rol_id = 1;
        $employee->departament_id = 1;
        $employee->save();
    }
}
