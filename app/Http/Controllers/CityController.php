<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{   
    public function getAll(){
        $city=City::all();
        return response()->json($city->toArray(),200);
    }
}
