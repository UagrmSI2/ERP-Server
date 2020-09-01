<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Carbon\Carbon;

class CountryController extends Controller
{
    public function get(){
        try{
            $countries = Country::all();
            return response()->json($countries->toArray(),200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }   
    public function post(Request $request){
        try{
            $country = new Country();
            $country->nombre = $request['nombre'];
            $country->created_at = Carbon::now();
            $country->updated_at = Carbon::now();
            $country->save();
            return response()->json('País Añadido con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function put(Request $request, $id){
        $country = Country::find($id);
        if($country == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $country->nombre = $request['nombre'];
            $country->created_at = Carbon::now();
            $country->updated_at = Carbon::now();
            $country->save();
            return response()->json('Pais actualizado con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function delete($id){
        $country = Country::find($id);
        if($country == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $country->delete();
            return response()->json('Pais eliminado con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
