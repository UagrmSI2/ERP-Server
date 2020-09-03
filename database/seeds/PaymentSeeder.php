<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $informaciondePagos=[
            [
            "metodo_de_pago"=>"Transferencia Bancaria",
            "moneda"=>"Bolivianos"
            ],
            [
            "metodo_de_pago"=>"Transferencia Bancaria",
            "moneda"=>"Dolares"   
            ],
            [
            "metodo_de_pago"=>"Efectivo",
            "moneda"=>"Bolivianos"
            ],
            [
            "metodo_de_pago"=>"Efectivo",
            "moneda"=>"Dolares"  
            ]
            ];
            foreach($informaciondePagos as $informacionPago){
                $pago= new Payment();
                $pago->metodo_de_pago=$informacionPago['metodo_de_pago'];
                $pago->moneda=$informacionPago['moneda'];
                $pago->created_at=Carbon::now();
                $pago->save();
            }
    }
}
