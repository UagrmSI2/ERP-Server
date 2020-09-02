<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use Carbon\Carbon;

class DepositController extends Controller
{
    public function get(){
        try{
            $deposits = Deposit::all();
            return response()->json($deposits->toArray(),200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }   
    public function post(Request $request){
        $deposit = new Deposit();
        try{
            $deposit->ubicacion = $request['ubicacion'];
            $deposit->office_id = $request['office_id'];
            $deposit->created_at = Carbon::now();
            $deposit->updated_at = Carbon::now();
            $deposit->save();
            return response()->json('Almacen añadido con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    } 
    public function put(Request $request,$id){
        $deposit = Deposit::find($id);
        if($deposit == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $deposit->ubicacion = $request['ubicacion'];
            $deposit->office_id = $request['office_id'];
            $deposit->created_at = Carbon::now();
            $deposit->updated_at = Carbon::now();
            $deposit->save();
            return response()->json('Deposito Actualizado con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function delete($id){
        $deposit = Deposit::find($id);
        if($deposit == null){
            return response()->json('ID no encontrado',404);
        }
        try{
            $deposit->delete();
            return response()->json('Deposito Eliminado con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
