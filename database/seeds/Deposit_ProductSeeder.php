<?php

use Illuminate\Database\Seeder;
use App\DepositProduct;
use Carbon\Carbon;
class Deposit_ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $InformacionDepositoProductos = [
            [
                "product_id"=>1,
                "deposit_id"=>1,
                "stock"=>150
            ],
        ];
        foreach($InformacionDepositoProductos as $InformacionDepositoProducto){
            $deposito_producto = new DepositProduct();
            $deposito_producto->product_id = $InformacionDepositoProducto['product_id'];
            $deposito_producto->deposit_id = $InformacionDepositoProducto['deposit_id'];
            $deposito_producto->stock = $InformacionDepositoProducto['stock'];
            $deposito_producto->created_at=Carbon::now();
            $deposito_producto->updated_at=Carbon::now();
            $deposito_producto->save();
        }
    }
}
