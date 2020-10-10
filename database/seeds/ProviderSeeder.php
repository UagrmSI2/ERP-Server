<?php

use Illuminate\Database\Seeder;
use App\Provider;
use Carbon\Carbon;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider=new Provider();
        $provider->empresa="empresa1";
        $provider->direccion="direccion";
        $provider->telefono="123445";
        $provider->created_at=Carbon::now();
        $provider->save();
    }
}
