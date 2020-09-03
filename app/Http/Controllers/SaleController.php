<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class SaleController extends Controller
{
    public function setNew(Request $request){
        try{
            $deposit_id=$request->deposit_id;
            $sale=new SaleNote();
            $sale->fecha=Carbon::now();
            $sale->client_id=$request->provider_id;
            $total_price=0;
            $sale->monto_total=0;
            $purchase->save();    
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
