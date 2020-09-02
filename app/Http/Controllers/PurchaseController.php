<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseNote;
use Carbon\Carbon;
use App\DepositProduct;
use App\Product;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    public function setNew(Request $request){
        try{
        $deposit_id=$request->deposit_id;
        $purchase=new PurchaseNote();
        $purchase->fecha=Carbon::now();
        $purchase->provider_id=$request->provider_id;
        $total_price=0;
        $purchase->monto_total=0;
        $purchase->save()
;        foreach($request['products'] as $product){
            $productInfo=Product::where('id',$product['id'])->first();
            $row=[
                'purchase_note_id'=>$purchase->id,
                'product_id'=>$product['id'],
                'deposit_id'=>$deposit_id,
                'cantidad'=>$product['cantidad'],
                'precio'=>$productInfo->costo*$product['cantidad']
            ];
            
            $total_price=$total_price+($row['cantidad']*$row['precio']);
            $deposit_product=DepositProduct::where('product_id',$product['id'])->where('deposit_id',$deposit_id)->first();
            if($deposit_product!=null){
                DB::table('deposit_products')
                ->where('product_id',$product['id'])
                ->where('deposit_id',$deposit_id)
                ->update([
                    'stock'=>$deposit_product->stock+$product['cantidad']
                ]);
            }else{
                $deposit_product=new DepositProduct();
                $deposit_product->product_id=$product['id'];
                $deposit_product->deposit_id=$deposit_id;
                $deposit_product->stock=$product['cantidad'];
                $deposit_product->save();
            }
            DB::table('purchase_details')->insert($row);
        }
        $purchase->monto_total=$total_price;
        
        $purchase->save();
        return response()->json('Correcto',200);
    }catch(Exception $e){
        return response()->json($e->getMessage(),500);
    }
    }
}
