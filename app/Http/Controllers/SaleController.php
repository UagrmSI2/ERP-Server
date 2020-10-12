<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Exception;
use App\SaleNote;
use Carbon\Carbon;
use App\DepositProduct;
use App\Product;
use App\SaleBills;
use App\SaleDetail;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function setNew(Request $request){
        try{
            $user=$request->user();
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
            AuthController::newActivity($user,'create_sale:ok'.$sale,'ERP-NEW SALE');

            $bill = new SaleBills();
            $bill->sale_note_id = $sale->id;
            $client = Client::find($sale->client_id);
            $bill->nombre = $client->nombre;
            $bill->apellido = $client->apellido;
            $bill->fecha = Carbon::now();
            $bill->monto = $sale->monto_total;
            $bill->save();

            return response()->json('Nota de Venta creada con exito',200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public function getAll(Request $request){
        $sales=SaleNote::all();
        $user=$request->user();
        $response=[];
        foreach($sales as $sale){
            $newProducts=[];
            $details=SaleDetail::where('sale_note_id',$sale->id)->get();
            foreach($details as $detail){
                $deposit_products=DepositProduct::where('id',$detail->deposit_product_id)->get();
                foreach($deposit_products as $deposit_product){
                    $productInfo=Product::where('id',$deposit_product->product_id)->first();
                    $products=[
                        "Nombre"=>$productInfo->nombre,
                        "Precio"=>$productInfo->precio,
                        "Cantidad"=>$detail->cantidad
                    ];
                    array_push($newProducts,$products);
                }   
            }
            $newSale=[
                "id"=>$sale->id,
                "Total"=>$sale->monto_total,
                "productos"=>$newProducts
            ];
            array_push($response,$newSale); 
        }
        AuthController::newActivity($user,'read_purchase:ok'.$sale,'ERP-SALES');
        return response()->json( $response,200);
    }
}
