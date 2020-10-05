<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;


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
}
