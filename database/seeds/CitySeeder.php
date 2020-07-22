<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'nombre'=>'Santa Cruz',
                'country_id'=>1,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'La Paz',
                'country_id'=>1,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'Camiri',
                'country_id'=>1,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'Montero',
                'country_id'=>1,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'Buenos Aires',
                'country_id'=>2,
                'created_at'=>Carbon::now() 
            ],
            [
                'nombre'=>'Salta',
                'country_id'=>2,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'Mar de Plata',
                'country_id'=>2,
                'created_at'=>Carbon::now()
            ],
            [
                'nombre'=>'Lima',
                'country_id'=>3,
                'created_at'=>Carbon::now()
            ]
        ]);
    }
}
