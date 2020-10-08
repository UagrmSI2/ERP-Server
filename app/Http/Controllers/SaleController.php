<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\SaleNote;
use Carbon\Carbon;
use App\DepositProduct;
use App\Product;
use App\SaleDetail;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function setNew(Request $request){
        try{
            $products=$request['products'];
            $sale=new SaleNote();
            $sale->fecha=Carbon::now();
            $sale->client_id=$request->client_id;
            $total_price=0;
            $sale->monto_total=0;
            $sale->payment_id=$request->payment_id;
            $sale->save();
            foreach($products as $product){
                $productInfo = Product::where('id',$product['id'])->first();
                $row = [
                    'sale_note_id'=>$sale->id,
                    'cantidad'=>$product['cantidad'],
                    'precio'=>$productInfo->precio*$product['cantidad']
                ];
                $total_price=$total_price+$row['precio'];
                $deposit_product=DepositProduct::where('product_id',$product['id'])
                ->where('deposit_id',$product['deposit_id'])->first();
                if($deposit_product!=null){
                    DB::table('deposit_products')
                    ->where('product_id',$product['id'])
                    ->where('deposit_id',$product['deposit_id'])
                    ->update([
                        'stock'=>$deposit_product->stock-$product['cantidad']
                    ]);
                    $row=[
                        'sale_note_id'=>$sale->id,
                        'cantidad'=>$product['cantidad'],
                        'precio'=>$productInfo->precio*$product['cantidad'],
                        'deposit_product_id'=>$deposit_product->id
                    ];
                }
                DB::table('sale_details')->insert($row);
            }
            $sale->monto_total=$total_price;
            $sale->save();
            return response()->json('Nota de Venta creada con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
