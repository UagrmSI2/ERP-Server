<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseNote;
use Carbon\Carbon;
use App\DepositProduct;
use App\Product;
use App\Provider;
use App\PurchaseDetail;
use App\PurchaseBills;
use Illuminate\Support\Facades\DB;
use Exception;


class PurchaseController extends Controller
{
    public function setNew(Request $request)
    {
        try {
            $user = $request->user();
            $deposit_id = $request->deposit_id;
            $purchase = new PurchaseNote();
            $purchase->fecha = Carbon::now();
            $purchase->provider_id = $request->provider_id;
            $total_price = 0;
            $purchase->monto_total = 0;
            $purchase->save();
            foreach ($request['products'] as $product) {
                $productInfo = Product::where('id', $product['id'])->first();
                $row = [
                    'purchase_note_id' => $purchase->id,
                    'cantidad' => $product['cantidad'],
                    'precio' => $productInfo->costo * $product['cantidad']
                ];
                $total_price = $total_price + ($row['precio']);
                $deposit_product = DepositProduct::where('product_id', $product['id'])->where('deposit_id', $deposit_id)->first();
                if ($deposit_product != null) {
                    DB::table('deposit_products')
                        ->where('product_id', $product['id'])
                        ->where('deposit_id', $deposit_id)
                        ->update([
                            'stock' => $deposit_product->stock + $product['cantidad']
                        ]);
                    $row = [
                        'purchase_note_id' => $purchase->id,
                        'cantidad' => $product['cantidad'],
                        'precio' => $productInfo->costo * $product['cantidad'],
                        'deposit_product_id' => $deposit_product->id
                    ];
                } else {
                    $deposit_product = new DepositProduct();
                    $deposit_product->product_id = $product['id'];
                    $deposit_product->deposit_id = $deposit_id;
                    $deposit_product->stock = $product['cantidad'];
                    $deposit_product->save();
                    $row = [
                        'purchase_note_id' => $purchase->id,
                        'cantidad' => $product['cantidad'],
                        'precio' => $productInfo->costo * $product['cantidad'],
                        'deposit_product_id' => $deposit_product->id
                    ];
                }
                DB::table('purchase_details')->insert($row);
            }
            $purchase->monto_total = $total_price;
            $purchase->save();
            AuthController::newActivity($user, 'create_purchase:ok' . $purchase, 'ERP-NEW PURCHASE');

            $bill = new PurchaseBills();
            $bill->purchase_note_id = $purchase->id;
            $prov = Provider::find($purchase->provider_id);
            $bill->nombre = $prov->empresa;
            $bill->fecha = Carbon::now();
            $bill->monto = $purchase->monto_total;
            $bill->save();

            return response()->json('Correcto', 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function getAll(Request $request)
    {
        $user = $request->user();
        $purchases = PurchaseNote::all();
        $response = [];

        foreach ($purchases as $purchase) {
            $newProducts = [];
            $details = PurchaseDetail::where('purchase_note_id', $purchase->id)->get();
            foreach ($details as $detail) {
                $deposit_products = DepositProduct::where('id', $detail->deposit_product_id)->get();
                foreach ($deposit_products as $deposit_product) {
                    $productInfo = Product::where('id', $deposit_product->product_id)->first();
                    $products = [
                        "nombre" => $productInfo->nombre,
                        "costo_por_unidad" => $productInfo->costo,
                        "cantidad" => $detail->cantidad
                    ];
                    array_push($newProducts, $products);
                }
            }
            $newPurchase = [
                "id" => $purchase->id,
                "costoTotal" => $purchase->monto_total,
                "productos" => $newProducts
            ];
            array_push($response, $newPurchase);
        }
        AuthController::newActivity($user, 'read_purchase:ok' . $purchases, 'ERP- PURCHASE');
        return response()->json($response, 200);
    }
}
