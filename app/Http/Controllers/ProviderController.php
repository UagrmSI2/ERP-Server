<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
use Carbon\Carbon;
class ProviderController extends Controller
{
    public function post(Request $request){

        $proveedor = new Provider();
        $proveedor->empresa = $request['empresa'];
        $proveedor->direccion = $request['direccion'];
        $proveedor->telefono = $request['telefono'];
        $proveedor->created_at=Carbon::now();
        $proveedor->updated_at=Carbon::now();
        $proveedor->save();
        return response()->json($proveedor, 200);
    }
    public function put(Request $request, $id){

        $proveedor = Provider::find($id);
        
        $proveedor->empresa = $request['empresa'];
        $proveedor->direccion = $request['direccion'];
        $proveedor->telefono = $request['telefono'];
        $proveedor->save();

        return response()->json('Datos del Proveedor Actualizado',200);
    }
    public function get(){
        $proveedores = Provider::All();
        return response()->json($proveedores, 200);
    }
    public function delete($id){
        $proveedor = Provider::find($id);
        $proveedor->delete();
        return response()->json('Proveedor Borrado con Exito',200);
    }
}
