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
    }
}
