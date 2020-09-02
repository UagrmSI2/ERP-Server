<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use Carbon\Carbon;

class OfficeController extends Controller
{
    public function get(){
        try{
            $offices = Office::all();
            return response()->json($offices->toArray(),200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function post(Request  $request){
        try{
            $office = new Office();
            $office->nombre = $request['nombre'];
            $office->city_id = $request['city_id'];
            $office->created_at = Carbon::now();
            $office->updated_at = Carbon::now();
            $office->save();
            return response()->json('Sucursal Añadida con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function put(Request $request, $id){
        $office = Office::find($id);
        if($office == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $office->nombre = $request['nombre'];
            $office->city_id = $request['city_id'];
            $office->created_at = Carbon::now();
            $office->updated_at = Carbon::now();
            $office->save();
            return response()->json('Sucursal actualizada con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);           
        }
    }
    public function delete($id){
        $office = Office::find($id);
        if($office == null){
            return response()->json('ID no encontrado',400);
        }
        try{
            $office->delete();
            return response()->json('Sucursal borrada con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
