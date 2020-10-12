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
            [ 
                "descripcion"=>"producto numero 2",
                "nombre"=> "producto2",
                "precio"=>150.00,
                "costo"=>110.00,
                "category_id"=>1
            ],
            [ 
                "descripcion"=>"producto numero 3",
                "nombre"=> "producto3",
                "precio"=>100.00,
                "costo"=>70.00,
                "category_id"=>2
            ],
            [ 
                "descripcion"=>"producto numero 4",
                "nombre"=> "producto4",
                "precio"=>120.00,
                "costo"=>80.00,
                "category_id"=>2
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
