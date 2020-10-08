<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AuthController extends Controller
{
    public static function sendEmail($view,$dataView,$person,$subject){
        try{
            Mail::send($view,$dataView,
            function($message)use($person,$subject){
                $message
                ->to($person->email,$person->name)
                ->subject($subject);
            });
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    public static function newActivity($user,$content,$action){
        try{
            $person=Employee::find($user->employee_id);
            DB::table('activities')->insert([
                'user_id'=>$user->id,
                'nombre'=>$person->nombre,
                'apellido'=>$person->apellido,
                'email'=>$user->email,
                'action'=>$action,
                'content'=>json_encode($content),
                'date'=>Carbon::now(),
            ]);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
