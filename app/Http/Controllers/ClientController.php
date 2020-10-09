<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Exception;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function post(Request $request){
        try{
            $client = new Client();
            $client->ci=$request['ci'];
            $client->nombre = $request['nombre'];
            $client->apellido = $request['apellido'];
            $client->telefono = $request['telefono'];
            $client->created_at = Carbon::now();
            $client->updated_at = Carbon::now();
            $client->save();
            return response()->json('Cliente Añadido con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
