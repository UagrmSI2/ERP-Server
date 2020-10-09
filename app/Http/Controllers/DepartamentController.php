<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;
use Exception;

class DepartamentController extends Controller
{
    public function getAll(){
        $departaments=Departament::all();
        return response()->json($departaments->toArray(),200);
    }
    public function post(Request $request){
        try{
            $departament=new Departament();
            $departament->nombre=$request['nombre'];
            $departament->cantidad_de_empleados['cantidad_de_empleados'];
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
