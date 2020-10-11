<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client=new Client();
        $client->ci="12345";
        $client->nombre="Jhon";
        $client->apellido="Doe";
        $client->telefono="61616161";
        $client->created_at=Carbon::now();
        $client->save();
        $client2=new Client();
        $client2->ci="12346";
        $client2->nombre="Jhon";
        $client2->apellido="Doe";
        $client2->telefono="61616";
        $client2->created_at=Carbon::now();
        $client2->save();
    }
}
