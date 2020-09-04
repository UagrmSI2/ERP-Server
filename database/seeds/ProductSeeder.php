<?php

use Illuminate\Database\Seeder;
use App\Product;
use Carbon\Carbon;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $informacionProductos = [
            [ 
                "descripcion"=>"producto numero 1",
                "nombre"=> "producto1",
                "precio"=>50.00,
                "costo"=>35.00,
                "category_id"=>1
            ],
        ];
        foreach($informacionProductos as $informacionProducto){
            $producto = new Product();
            $producto->descripcion = $informacionProducto['descripcion'];
            $producto->nombre = $informacionProducto['nombre'];
            $producto->precio = $informacionProducto['precio'];
            $producto->costo = $informacionProducto['costo'];
            $producto->category_id = $informacionProducto['category_id'];
            $producto->created_at=Carbon::now();
            $producto->updated_at=Carbon::now();
            $producto->save();
        }
    }
}
