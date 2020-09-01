<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use Carbon\Carbon;
class CityController extends Controller
{   
    public function getAll(){
        try{
            $city=City::all();
            return response()->json($city->toArray(),200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function post(Request $request){
        try{
            $city = new City();
            $city->nombre = $request['nombre'];
            $city->country_id = $request['country_id'];
            $city->created_at = Carbon::now();
            $city->updated_at = Carbon::now();
            $city->save();
            return response()->json('Ciudad añadida con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function put(Request $request,$id){
        $city = City::find($id);
        if($city == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $city->nombre = $request['nombre'];
            $city->country_id = $request['country_id'];
            $city->created_at = Carbon::now();
            $city->updated_at = Carbon::now();
            $city->save();
            return response()->json('Datos de la Ciudad Actualizados',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function delete($id){
        $city = City::find($id);
        if($city == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $city->delete();
            return response()->json('Ciudad eliminada con Exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
