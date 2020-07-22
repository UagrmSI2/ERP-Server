<?php

use Illuminate\Database\Seeder;
use App\Country;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryNames=[
            "Bolivia",
            "Argentina",
            "Peru"
        ];
        foreach($countryNames as $countryName){
            $country=new Country();
            $country->nombre=$countryName;
            $country->created_at=Carbon::now();
            $country->save();
        }
    }
}
