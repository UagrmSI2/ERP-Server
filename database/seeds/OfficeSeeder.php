<?php

use Illuminate\Database\Seeder;
use App\Office;
use Carbon\Carbon;
class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $InformacionSucursales = [
            [
                "nombre"=>"Sucursal1",
                "city_id"=>1
            ],
        ];
        foreach($InformacionSucursales as $InformacionSucursal){
            $sucursal = new Office();
            $sucursal->nombre = $InformacionSucursal['nombre'];
            $sucursal->city_id = $InformacionSucursal['city_id'];
            $sucursal->created_at=Carbon::now();
            $sucursal->updated_at=Carbon::now();
            $sucursal->save();
        }
    }
}
