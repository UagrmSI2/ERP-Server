<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    public function getAll(){
        $activity=Activity::all();
        return response()->json($activity->toArray(),200);
    }
}
