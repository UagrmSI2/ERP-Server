<?php

use Illuminate\Database\Seeder;
use App\Deposit;
use Carbon\Carbon;
class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $InformacionDepositos = [
            [
                "ubicacion"=>"la salle calle 2",
                "office_id"=>1
            ],
        ];
        foreach($InformacionDepositos as $InformacionDeposito){
            $deposito = new Deposit();
            $deposito->ubicacion = $InformacionDeposito['ubicacion'];
            $deposito->office_id = $InformacionDeposito['office_id'];
            $deposito->created_at=Carbon::now();
            $deposito->updated_at=Carbon::now();
            $deposito->save();
        }
    }
}
