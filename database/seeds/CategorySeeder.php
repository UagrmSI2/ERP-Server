<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\Carbon;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $InformacionCategorias = [
            [
                "nombre"=>"categoria1",
                "descripcion"=>"productos de la categoria1"
            ],
            [
                "nombre"=>"categoria2",
                "descripcion"=>"productos de la categoria2"
            ],
        ];
        foreach($InformacionCategorias as $Informacioncategoria){
            $categoria = new Category();
            $categoria->nombre = $Informacioncategoria['nombre'];
            $categoria->descripcion =$Informacioncategoria['descripcion'];
            $categoria->created_at=Carbon::now();
            $categoria->updated_at=Carbon::now();
            $categoria->save();
        }
    }
}
